import "./bootstrap";

import Alpine from "alpinejs";
import Choices from "choices.js";
import focus from "@alpinejs/focus";
import axios from "axios";
import Chart from "chart.js/auto";
Alpine.plugin(focus);

window.Alpine = Alpine;

if (document.querySelector(".select-choice")) {
    new Choices(".select-choice");
}

document.addEventListener("alpine:init", () => {
    Alpine.data("imgPreview", () => ({
        imgsrc: null,
        previewFile() {
            let file = this.$refs.myFile.files[0];
            if (!file || file.type.indexOf("image/") === -1) return;
            this.imgsrc = null;
            let reader = new FileReader();

            reader.onload = (e) => {
                this.imgsrc = e.target.result;
            };

            reader.readAsDataURL(file);
        },
    }));
});

window.dragDropList = function (items, dragging, dropping) {
    if (dragging !== null && dropping !== null) {
        if (dragging < dropping) {
            items = [
                ...items.slice(0, dragging),
                ...items.slice(dragging + 1, dropping + 1),
                items[dragging],
                ...items.slice(dropping + 1),
            ];
        } else {
            items = [
                ...items.slice(0, dropping),
                items[dragging],
                ...items.slice(dropping, dragging),
                ...items.slice(dragging + 1),
            ];
        }
        dropping = null;
    }

    updateChapterOrders(items);

    return items;
};

let abortController = null;

function updateChapterOrders(items) {
    if (!abortController) {
        abortController = new AbortController();
    } else {
        console.log("Console, request can only executed once!");
        return;
    }

    const updatedItems = items.map((item, idx) => {
        let next_chapter_id = null;
        if (idx !== items.length - 1) {
            next_chapter_id = items[idx + 1].id;
        }
        return {
            id: item.id,
            next_chapter_id: next_chapter_id,
        };
    });

    const apiUrl = "/teacher/chapter/updateorders";

    axios
        .put(apiUrl, {
            chapter_order: updatedItems,
        })
        .then((response) => {
            abortController = null;
        })
        .catch((error) => {
            console.log("error", error);
        });
}

window.chart = (async function () {
    if (!document.querySelector("#totalRevenue")) {
        return;
    }

    try {
        const { data } = await axios.get("/api/teacher/revenue");
        const canvas = document.getElementById("totalRevenue");

        if (Array.isArray(data.data)) {
            const revenueData = data.data;
            new Chart(canvas, {
                type: "bar",
                data: {
                    labels: revenueData.map(
                        (row) => row.title.slice(0, 25) + "...",
                    ),
                    datasets: [
                        {
                            label: "Total revenue",
                            data: revenueData.map((row) => row.revenue),
                        },
                    ],
                },
            });
        } else {
            console.error("Something wen wrong!", error);
        }
    } catch (error) {
        console.error("Error getting data from API", error);
    }
})();

let previewModal, videoFrame;

if (document.querySelector("#previewModal") !== null) {
    previewModal = new bootstrap.Modal("#previewModal");
    videoFrame = document.querySelector("#videoFrame");
}

window.previewChapter = function (videoId) {
    renderVideo(videoId);
    previewModal.show();
};

window.closePreview = function () {
    videoFrame.innerHTML = "";
    previewModal.hide();
};

function renderVideo(videoId) {
    const iFrame = document.createElement("iframe");
    iFrame.setAttribute("width", "560");
    iFrame.setAttribute("height", "315");
    iFrame.setAttribute("title", "Youtube video player");
    iFrame.setAttribute("frameborder", "0");
    iFrame.setAttribute(
        "allow",
        "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share",
    );
    iFrame.setAttribute("allowfullscreen", "");

    iFrame.setAttribute("src", "https://www.youtube.com/embed/" + videoId);

    videoFrame.innerHTML = "";
    videoFrame.appendChild(iFrame);
}

window.handlePreviewLink = function (e) {
    const link = e.target.closest(".modal-video-preview-link");
    const { videoId } = link.dataset;

    renderVideo(videoId);
};

window.chapterVideoFileName = "";
window.chapterVideoURL = "";
window.chapterVideoFile = null;
window.youtubeURL = "";
window.isSubmitVideoButtonDisabled = true;
window.chapterVideoDuration = 0;

window.handleVideoUrlChange = function () {
    this.isSubmitVideoButtonDisabled = false;
};

Alpine.start();

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
                        (row) => row.title.slice(0, 25) + "..."
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

window.videoId = null;
let previewModal, videoFrame, previewAccordion;

if (document.querySelector("#previewModal") !== null) {
    previewModal = new bootstrap.Modal("#previewModal");
    videoFrame = document.querySelector("#videoFrame");
    previewAccordion = document.querySelector("#previewAccordion");
}

window.previewChapter = function (e) {
    const { url: videoId, sections } = e.target.dataset;
    const freeSections = JSON.parse(sections);
    const accordion = createAccordion(freeSections, videoId);
    renderVideo(videoId);
    previewAccordion.innerHTML = "";
    previewAccordion.appendChild(accordion);
    previewModal.show();
};

function renderVideo(videoId) {
    const iFrame = document.createElement("iframe");
    iFrame.setAttribute("width", "560");
    iFrame.setAttribute("height", "315");
    iFrame.setAttribute("title", "Youtube video player");
    iFrame.setAttribute("frameborder", "0");
    iFrame.setAttribute(
        "allow",
        "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    );
    iFrame.setAttribute("allowfullscreen", "");

    iFrame.setAttribute("src", "https://www.youtube.com/embed/" + videoId);

    videoFrame.innerHTML = "";
    videoFrame.appendChild(iFrame);
}

function createAccordion(sections, videoId) {
    const fragment = document.createDocumentFragment();
    const ungroupedSections = sections.filter((items) => items.is_ungrouped);

    sections.forEach((item) => {
        const activeSection =
            item.chapters.find((chapter) => chapter.video_url === videoId) !==
            undefined;

        if (!item.is_ungrouped) {
            const accordionItem = document.createElement("div");
            accordionItem.className = "accordion-item";

            const accordionHeader = document.createElement("h2");
            accordionHeader.className = "accordion-header";
            accordionHeader.id = `preview-heading${item.id}`;

            const accordionButton = document.createElement("button");
            accordionButton.className = `px-2 accordion-button ${
                activeSection ? "" : "collapsed"
            } bg-neutral-50`;
            accordionButton.type = "button";
            accordionButton.setAttribute("data-bs-toggle", "collapse");
            accordionButton.setAttribute(
                "data-bs-target",
                `#preview-collapse${item.id}`
            );
            accordionButton.setAttribute(
                "aria-expanded",
                activeSection ? "true" : "false"
            );
            accordionButton.setAttribute(
                "aria-controls",
                `preview-collapse${item.id}`
            );
            accordionButton.textContent = item.title;

            accordionHeader.appendChild(accordionButton);

            const accordionCollapse = document.createElement("div");
            accordionCollapse.id = `preview-collapse${item.id}`;
            accordionCollapse.className = `accordion-collapse collapse ${
                activeSection ? "show" : ""
            }`;
            accordionCollapse.setAttribute(
                "aria-labelledby",
                `preview-heading${item.id}`
            );
            accordionCollapse.setAttribute(
                "data-bs-parent",
                "#previewAccordion"
            );

            const accordionBody = document.createElement("div");
            accordionBody.className = "accordion-body ps-2";

            item.chapters.forEach((chapter) => {
                const chapterDiv = document.createElement("div");
                chapterDiv.className =
                    "py-2 d-flex justify-content-between ps-4 align-items-center";

                if (videoId === chapter.video_url)
                    chapterDiv.classList.add("text-primary");

                const leftDiv = document.createElement("div");
                leftDiv.className =
                    "gap-2 d-flex justify-content-center align-items-center";

                const playIcon = document.createElement("span");
                playIcon.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-circle"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>';

                const chapterTitle = document.createElement("span");
                chapterTitle.textContent = chapter.title;

                leftDiv.appendChild(playIcon);
                leftDiv.appendChild(chapterTitle);

                const rightDiv = document.createElement("div");
                rightDiv.className =
                    "gap-2 d-flex justify-content-center align-items-center";

                const playButton = document.createElement("button");
                playButton.setAttribute("data-url", chapter.video_url);
                playButton.className = "previewLink btn";
                playButton.textContent = "play";

                playButton.addEventListener("click", handlePreviewLink);

                const durationSpan = document.createElement("span");
                durationSpan.textContent = secondsToHMS(chapter.video_duration) || "-";

                rightDiv.appendChild(playButton);
                rightDiv.appendChild(durationSpan);

                chapterDiv.appendChild(leftDiv);
                chapterDiv.appendChild(rightDiv);

                accordionBody.appendChild(chapterDiv);
            });

            accordionCollapse.appendChild(accordionBody);
            accordionItem.appendChild(accordionHeader);
            accordionItem.appendChild(accordionCollapse);

            fragment.appendChild(accordionItem);
        }
    });
    if (ungroupedSections.length) {
        ungroupedSections[0].chapters.forEach((chapter) => {
            const container = document.createElement("div");
            const leftDiv = document.createElement("div");
            const rightDiv = document.createElement("div");
            container.className =
                "gap-2 py-1 ps-4 d-flex align-items-center justify-content-between";
            leftDiv.className = "gap-2 py-2 d-flex align-items-center";
            rightDiv.className = "gap-2 d-flex align-items-center";

            if (videoId === chapter.video_url)
                container.classList.add("text-primary");

            const playIcon = document.createElement("span");
            playIcon.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-circle"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>';
            const title = document.createElement("span");
            title.innerText = chapter.title;
            leftDiv.appendChild(playIcon);
            leftDiv.appendChild(title);
            const playButton = document.createElement("button");
            playButton.setAttribute("data-url", chapter.video_url);
            playButton.className = "btn previewLink";
            playButton.innerText = "play";

            playButton.addEventListener("click", handlePreviewLink);
            const videoDuration = document.createElement("span");
            videoDuration.innerText = secondsToHMS(chapter.video_duration) || "-";
            rightDiv.appendChild(playButton);
            rightDiv.appendChild(videoDuration);

            container.appendChild(leftDiv);
            container.appendChild(rightDiv);

            fragment.appendChild(container);
        });
    }

    return fragment;
}

function handlePreviewLink(e) {
    const { url } = e.target.dataset;
    const previewLinks = document.querySelectorAll(".previewLink");
    previewLinks.forEach((link) => {
        const grandparent = link.parentElement.parentElement;
        grandparent.classList.remove("text-primary");
    });
    e.target.parentElement.parentElement.classList.add("text-primary");
    renderVideo(url);
}

function secondsToHMS(seconds) {
    if(!seconds) return null;
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;

    if (hours > 0) {
        const formattedHours = hours.toString().padStart(2, "0");
        const formattedMinutes = minutes.toString().padStart(2, "0");
        const formattedSeconds = remainingSeconds.toString().padStart(2, "0");
        return `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
    } else {
        const formattedMinutes = minutes.toString().padStart(2, "0");
        const formattedSeconds = remainingSeconds.toString().padStart(2, "0");
        return `${formattedMinutes}:${formattedSeconds}`;
    }
}

window.chapterVideoFileName = "";
window.chapterVideoURL = "";
window.chapterVideoFile = null;
window.youtubeURL = "";
window.isSubmitVideoButtonDisabled = true;
window.chapterVideoDuration = 0;

const x = {
    chapterVideoFileName: chapterVideoFileName,
    chapterVideoFile: chapterVideoFile,
    chapterVideoURL: chapterVideoURL,
    youtubeURL: youtubeURL,
    isSubmitVideoButtonDisabled: isSubmitVideoButtonDisabled,
    chapterVideoDuration: chapterVideoDuration,
};

window.handleVideoUrlChange = async function (e) {
    const {
        data: { duration },
    } = await getVideoInfo(e.target.value);
    this.chapterVideoDuration = duration;
    this.isSubmitVideoButtonDisabled = false;
};

async function getVideoInfo(videoUrl) {
    try {
        const response = await axios.post(
            "https://echo-tube.vercel.app/get-video-info",
            {
                videoUrl: videoUrl,
            }
        );

        return response.data;
    } catch (error) {
        console.error("Error fetching video info:", error);
        return null;
    }
}

Alpine.start();

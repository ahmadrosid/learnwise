import "./bootstrap";
import "fastbootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

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
    return items;
};

Alpine.start();

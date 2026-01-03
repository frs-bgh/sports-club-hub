import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    // custom file input label (profile photo)
    const fileInput = document.querySelector('input[type="file"][name="profile_photo"]');
    const fileNameEl = document.querySelector("[data-file-name]");

    if (fileInput && fileNameEl) {
        fileInput.addEventListener("change", () => {
            const file = fileInput.files?.[0];
            fileNameEl.textContent = file ? file.name : "no file selected";
        });
    }
});

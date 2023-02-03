// input image preview
imageInput.onchange = evt => {
    const [file] = imageInput.files
    if (file) {
        imagePreviewContainer.style.display = 'block';
        imagePreview.src = URL.createObjectURL(file)
    }
}

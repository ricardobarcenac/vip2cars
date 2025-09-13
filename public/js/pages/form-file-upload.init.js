var previewTemplate, dropzone, dropzonePreviewNode = document.querySelector("#dropzone-preview-list"),
    inputMultipleElements = (dropzonePreviewNode.id = "", dropzonePreviewNode && (previewTemplate = dropzonePreviewNode.parentNode.innerHTML, dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode), dropzone = new Dropzone(".dropzone", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview"
    })));

var previewTemplateF, dropzoneF, dropzonePreviewNodeF = document.querySelector("#dropzone-preview-list-fotos"),
    inputMultipleElementsF = (dropzonePreviewNodeF.id = "", dropzonePreviewNodeF && (previewTemplateF = dropzonePreviewNodeF.parentNode.innerHTML, dropzonePreviewNodeF.parentNode.removeChild(dropzonePreviewNodeF), dropzone = new Dropzone(".dropzone-fotos", {
        url: "https://httpbin.org/post",
        method: "post",
        acceptedFiles: 'image/*',
        maxFilesize: 2, // Limit file size to 2MB
        maxFiles: 5, // Allow only 5 files to be uploaded
        previewTemplate: previewTemplateF,
        previewsContainer: "#dropzone-preview-fotos",
        dictInvalidFileType: "Solo se permiten imágenes.", // Custom error message for invalid file types
        dictCancelUploadConfirmation: "¿Estás seguro que deseas eliminar el archivo?"
    })));

var previewTemplateF, dropzoneF, dropzonePreviewNodeF = document.querySelector("#dropzone-preview-list-ficha"),
    inputMultipleElementsF = (dropzonePreviewNodeF.id = "", dropzonePreviewNodeF && (previewTemplateF = dropzonePreviewNodeF.parentNode.innerHTML, dropzonePreviewNodeF.parentNode.removeChild(dropzonePreviewNodeF), dropzone = new Dropzone(".dropzone-ficha", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplateF,
        previewsContainer: "#dropzone-preview-ficha"
    })));

var previewTemplateF, dropzoneF, dropzonePreviewNodeF = document.querySelector("#dropzone-preview-list-videos"),
    inputMultipleElementsF = (dropzonePreviewNodeF.id = "", dropzonePreviewNodeF && (previewTemplateF = dropzonePreviewNodeF.parentNode.innerHTML, dropzonePreviewNodeF.parentNode.removeChild(dropzonePreviewNodeF), dropzone = new Dropzone(".dropzone-videos", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplateF,
        previewsContainer: "#dropzone-preview-videos"
    })));
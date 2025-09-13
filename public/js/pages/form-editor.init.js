var ckClassicEditor = document.querySelectorAll(".ckeditor-classic"),
    snowEditor = (ckClassicEditor && Array.from(ckClassicEditor).forEach(function() {
        ClassicEditor.create(document.querySelector(".ckeditor-classic")).then(function(e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function(e) {
            console.error(e)
        })
    }));
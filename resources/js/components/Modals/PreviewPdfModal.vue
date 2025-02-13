<template>
    <div class="modal fade" id="previewPdf" tabindex="-1" aria-labelledby="previewPdfLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe ref="pdfIframe" style="width: 100%; height: 500px"></iframe>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "PreviewPdfModal",
    props: {
        refPdfIframe: {
            type: String,
        },
    }, methods: {
        getIframe() {
            return this.$refs.pdfIframe;
        },
    }
}
</script>

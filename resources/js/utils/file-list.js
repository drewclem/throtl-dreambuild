import { ref } from "vue";

export default function () {
    const files = ref([]);

    function addFiles(newFiles) {
        // loop through newFiles and reduce image size
        const newUploadableFiles = [...newFiles]
            .map((file) => {
                const newFile = new UploadableFile(file);
                const img = new Image();
                img.src = newFile.url;

                img.onload = () => {
                    const elem = document.createElement("canvas");
                    const width = 800;
                    const scaleFactor = width / img.width;
                    elem.width = width;
                    elem.height = img.height * scaleFactor;
                    const ctx = elem.getContext("2d");

                    // img.width and img.height will contain the original dimensions
                    ctx.drawImage(img, 0, 0, width, img.height * scaleFactor);
                    ctx.canvas.toBlob(
                        (blob) => {
                            const file = new File([blob], newFile.name, {
                                type: "image/jpeg",
                                lastModified: Date.now(),
                            });
                            newFile.file = file;
                            newFile.url = URL.createObjectURL(file);
                        },
                        "image/jpeg",
                        1
                    );
                };

                return newFile;
            })
            .filter((file) => !fileExists(file.id))
            .filter((file) => validType(file.type));

        files.value = files.value.concat(newUploadableFiles);
    }

    function fileExists(otherId) {
        return files.value.some(({ id }) => id === otherId);
    }

    function validType(fileType) {
        const validTypes = [
            "image/jpeg",
            "image/png",
            "image/jpg",
            "image/heic",
        ];

        const isValid = validTypes.filter((type) => {
            return fileType.includes(type);
        });

        return isValid.length > 0;
    }

    function removeFile(index) {
        files.value.splice(index);
    }

    return { files, addFiles, removeFile };
}

class UploadableFile {
    constructor(file) {
        this.file = file;
        this.id = `${file.name}-${file.size}-${file.lastModified}-${file.type}`;
        this.url = URL.createObjectURL(file);
        this.name = file.name;
        this.type = file.type;
        this.status = null;
        this.size = file.size;
    }
}

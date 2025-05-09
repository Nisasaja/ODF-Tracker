document.addEventListener("DOMContentLoaded", function () {
    const downloadButton = document.getElementById("downloadButton");
    const loader = document.getElementById("loader");

    downloadButton.addEventListener("click", function () {
        loader.style.display = "block"; // Tampilkan loader

        fetch(downloadUrl)
            .then((response) => {
                if (!response.ok) throw new Error("Response tidak OK");
                return response.blob();
            })
            .then((blob) => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "penerima.csv";
                document.body.appendChild(a);
                a.click();
                a.remove();
                loader.style.display = "none"; // Sembunyikan loader
            })
            .catch((error) => {
                console.error("Unduhan gagal:", error);
                loader.style.display = "none"; // Sembunyikan loader
                alert("Unduhan gagal. Silakan coba lagi.");
            });
    });
});

function adjustSidebar() {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");
    const header = document.querySelector("header"); // ヘッダーの要素に合わせて調整してください
    const footer = document.querySelector("footer"); // フッターの要素に合わせて調整してください

    function update() {
        const headerRect = header.getBoundingClientRect();
        const footerRect = footer.getBoundingClientRect();
        const mainContentHeight = mainContent.offsetHeight;
        const sidebarHeight = sidebar.scrollHeight;

        if (headerRect.bottom > 0) {
            sidebar.style.top = `${headerRect.bottom}px`;
        } else {
            sidebar.style.top = "0px";
        }

        if (footerRect.top < window.innerHeight) {
            sidebar.style.bottom = `${window.innerHeight - footerRect.top}px`;
        } else {
            sidebar.style.bottom = "0px";
        }

        const availableHeight =
            window.innerHeight -
            parseInt(sidebar.style.top) -
            parseInt(sidebar.style.bottom || 0);

        if (mainContentHeight > sidebarHeight) {
            sidebar.style.position = "static";
            sidebar.style.height = "auto";
            sidebar.style.maxHeight = "none";
            sidebar.style.overflowY = "visible";
        } else {
            sidebar.style.position = "sticky";
            sidebar.style.height = "auto";
            sidebar.style.maxHeight = `${availableHeight}px`;
            sidebar.style.overflowY = "auto";
        }
    }

    window.addEventListener("scroll", update);
    window.addEventListener("resize", update);
    update(); // 初期化時に一度実行
}

window.addEventListener("load", adjustSidebar);

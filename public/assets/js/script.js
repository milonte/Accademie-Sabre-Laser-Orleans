function ShowContent(id) {
    let target = $(".hidden:nth-of-type(1)")[id-1];

    if (target.style.display === "none") {
        target.style.display = "flex";
    } else {
        target.style.display = "none";
    }
} 

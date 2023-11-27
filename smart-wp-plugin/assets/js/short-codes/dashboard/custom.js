window.addEventListener("load", function() {

    // store tabs variables
    var tabs = document.querySelectorAll("ul.nav-tabs > li");

    for (i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", switchTab);
    }

    function switchTab(event) {
        event.preventDefault();

        document.querySelector("ul.nav-tabs li.active").classList.remove("active");
        document.querySelector(".tab-pane.active").classList.remove("active");

        var clickedTab = event.currentTarget;
        var anchor = event.target;
        var activePaneID = anchor.getAttribute("href");

        clickedTab.classList.add("active");
        document.querySelector(activePaneID).classList.add("active");

    }

});
function showModal(modal, formid, title, ids = null) {
    jQuery("#" + formid).trigger('reset');
    jQuery("#" + modal + "-title").text(title);
    jQuery("label.error").remove();
    jQuery("#" + modal).modal("show");

}

function showOnlyModal(modal, title) {
    jQuery("#" + modal + "-title").text(title);
    jQuery("label.error").remove();
    jQuery("#" + modal).modal("show");
}
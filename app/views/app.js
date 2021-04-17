import UIkit from "uikit";
import Icons from "../../node_modules/uikit/dist/js/uikit-icons";
import "../../assets/less/theme.less";
window.addEventListener("load", () => {
    UIkit.use(Icons);

    const aElements = document.getElementsByTagName("a");

    for (let index = 0; index < aElements.length; index++) {
        const element = aElements[index];
        element.addEventListener("click", function (event) {
            if (event.target.href && !event.target.getAttribute("target")) {
                event.preventDefault();
                var bodyElement = document.getElementById("isbody");
                bodyElement.classList.add("uk-animation-reverse");
                bodyElement.classList.add("uk-animation-fade");
                //bodyElement.classList.add("uk-animation-fast");
                setTimeout(() => {
                    window.location = event.target.href;
                }, 200);
            }
        });
    }
});

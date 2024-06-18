import axios from "axios";

export default function exampleComponent() {
    console.log("Example Component Loaded 2");

    axios.get("comment").then(() => {
        console.log("ww");
    });
    console.log("AXIOS_URL", AXIOS_URL);
}

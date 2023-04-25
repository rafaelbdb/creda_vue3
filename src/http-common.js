import axios from "axios";
export default axios.create({
  baseURL: "http://creda_vue3/",
  headers: {
    "Content-type": "application/json"
  }
});
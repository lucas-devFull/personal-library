import axios from "axios";

export default axios.create({
  baseURL: "https://www.googleapis.com/books/v1",
  headers: {
    "content-type": "application/json",
  },
});

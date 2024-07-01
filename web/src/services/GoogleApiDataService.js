import api from "./api/GoogleApiBooks";

const API_KEY = import.meta.env.VITE_SOME_KEY || "";
debugger;
class GoogleApiDataService {
  getDefaultBooks() {
    return api.get(
      `/volumes?q=subject:Computers&orderBy=relevance&key=${API_KEY}`
    );
  }

  getByCategory(category = "") {
    return api.get(
      `/volumes?q=subject:${encodeURIComponent(
        category
      )}&orderBy=relevance&key=${API_KEY}`
    );
  }

  findByTerm(term = "") {
    return api.get(`/volumes?q=${term}&orderBy=relevance&key=${API_KEY}`);
  }
}

export default new GoogleApiDataService();

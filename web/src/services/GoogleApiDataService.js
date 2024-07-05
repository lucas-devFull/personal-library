import api from "./api/GoogleApiBooks";

const API_KEY = import.meta.env.VITE_SOME_KEY || "";
class GoogleApiDataService {
  getDefaultBooks(offset = 0) {
    offset = Number(offset) ? `&startIndex=${offset}` : "";
    return api.get(
      `/volumes?q=subject:Drama&orderBy=relevance&maxResults=12${offset}&key=${API_KEY}`
    );
  }

  getByCategory(category = "") {
    return api.get(
      `/volumes?q=subject:${encodeURIComponent(
        category
      )}&orderBy=relevance&maxResults=12${offset}&key=${API_KEY}`
    );
  }

  findByTerm(term = "", offset = 0) {
    offset = Number(offset) ? `&startIndex=${offset}` : "";
    return api.get(
      `/volumes?q=${term}&orderBy=relevance&maxResults=12${offset}&key=${API_KEY}`
    );
  }
}

export default new GoogleApiDataService();

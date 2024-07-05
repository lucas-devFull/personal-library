import api from "./api/Library";

class LibraryDataService {
  getAll(valueSearch = "") {
    let search = valueSearch.length > 0 ? "/?search=" + valueSearch : "";
    return api.get("/library" + search);
  }

  create(data = []) {
    return api.post("/library", data);
  }

  delete(bookId = 0) {
    return api.delete(`/library/${bookId}`);
  }
  updateBook(dataUpdate, bookId = 0) {
    return api.post(`/library/${bookId}`, dataUpdate);
  }

  findById(bookId = 0) {
    return api.get(`/library/${bookId}`);
  }

  findBySearch(term = "") {
    return api.get(`/library/${term}`);
  }
}

export default new LibraryDataService();

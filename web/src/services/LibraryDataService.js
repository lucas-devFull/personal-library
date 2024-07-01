import api from "./api/Library";

class LibraryDataService {
  getAll() {
    return api.get("/book");
  }

  create(data = []) {
    return api.post("/book", data);
  }

  delete(bookId = 0) {
    return api.delete(`/book/${bookId}`);
  }
  update(dataUpdate = 0, bookId = 0) {
    return api.put(`/book/${bookId}`, dataUpdate);
  }

  find(bookId = 0) {
    return api.get(`/book/${bookId}`);
  }
}

export default new LibraryDataService();

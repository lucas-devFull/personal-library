<script setup>
import ImgNotFound from "../assets/Explore/not_found.webp";
import "../assets/Explore/style.css";
</script>

<template>
  <div class="container container-explore">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-center" role="search">
          <input
            @keyup="(e) => searchBook(e.target.value)"
            class="form-control me-2"
            type="search"
            placeholder="Pesquise um titulo"
            aria-label="Search"
          />
        </div>
      </div>

      <div class="d-flex align-items-center" v-if="loading">
        <strong role="status">Loading...</strong>
        <div class="spinner-border ms-auto" aria-hidden="true"></div>
      </div>

      <div
        class="col-md-12 container-books"
        @scrollend="
          () => {
            if (totalBooks > books.length) getBooks(true);
          }
        "
        v-if="!loading"
      >
        <div class="row">
          <div class="col-sm-12 col-lg-3 col-md-6 mt-4" v-for="book in books">
            <div class="card card-book">
              <a :href="book.volumeInfo?.infoLink" target="_blank" class="none">
                <span class="mb-5">{{ book.volumeInfo?.title }}</span> Saiba
                mais</a
              >
              <img
                :src="
                  book.volumeInfo?.imageLinks?.smallThumbnail
                    ? book.volumeInfo.imageLinks.smallThumbnail
                    : ImgNotFound
                "
                class="img-thumbnail card-img-top img-hover h-100"
                :alt="book.volumeInfo?.title"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GoogleApiDataService from "../services/GoogleApiDataService";
export default {
  data() {
    return {
      valueSearch: "",
      loading: false,
      typingTimer: null,
      books: [],
      totalBooks: 0,
    };
  },
  methods: {
    searchBook(value) {
      this.valueSearch = value;
      this.loading = true;
      this.typingTimer !== null && clearTimeout(this.typingTimer);
      this.typingTimer = setTimeout(this.getBooks, 600);
    },
    getBooks(pagination = false) {
      if (this.valueSearch.length > 0) {
        this.findBooksByTerm(pagination);
      } else {
        this.getDefaultBooks();
      }
    },
    findBooksByTerm(pagination = false) {
      GoogleApiDataService.findByTerm(
        this.valueSearch,
        pagination ? this.books.length : 0
      ).then((res) => {
        if (!pagination) this.books = [];
        this.setBooks(res.data);
      });
    },
    getDefaultBooks() {
      GoogleApiDataService.getDefaultBooks(this.books.length).then((res) => {
        this.setBooks(res.data);
      });
    },
    setBooks(data) {
      data = data ? data : {};
      if (data && typeof data == "object" && data.hasOwnProperty("totalItems"))
        this.totalBooks = data.totalItems;

      if (data && typeof data == "object" && data.hasOwnProperty("items"))
        if (this.totalBooks > this.books.length) {
          this.books = [...this.books, ...data.items];
          this.loading = false;
        }
    },
  },
  watch: {},
  mounted() {
    this.getDefaultBooks();
  },
};
</script>

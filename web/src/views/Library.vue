<script setup>
import ImgNotFound from "../assets/Explore/not_found.webp";
import "../assets/Your_library/style.css";
</script>

<template>
  <div
    class="modal fade"
    id="addBook"
    data-bs-theme="dark"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            Informações do livro
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            id="close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <label for="title" class="label-modal form-label"> Titulo </label>
              <input
                type="text"
                v-model="fields.title"
                class="form-control"
                id="title"
              />
            </div>

            <div class="col-md-4">
              <label for="author" class="label-modal form-label"> Autor </label>
              <input
                type="text"
                class="form-control"
                id="author"
                v-model="fields.author"
              />
            </div>

            <div class="col-md-4">
              <label for="publication_year" class="label-modal form-label">
                Ano de publicação
              </label>
              <input
                type="number"
                class="form-control"
                id="publication_year"
                v-model="fields.publication_year"
              />
            </div>

            <div class="col-md-6">
              <label for="number_pages" class="label-modal form-label">
                Numero de páginas
              </label>
              <input
                type="number"
                class="form-control"
                id="number_pages"
                v-model="fields.number_pages"
              />
            </div>

            <div class="col-md-6">
              <label for="actual_page" class="label-modal form-label">
                Pagina em leitura atual</label
              >
              <input
                type="number"
                class="form-control"
                id="actual_page"
                aria-describedby="emailHelp"
                v-model="fields.actual_page"
              />
              <div id="emailHelp" class="form-text">
                Desconsidere se clicar em lido.
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-check">
                <input
                  type="checkbox"
                  class="form-check-input"
                  id="status"
                  :checked="fields.status > 0 ? true : false"
                  v-model="fields.status"
                />
                <label for="status" class="label-modal-check form-check-label">
                  Lido ?
                </label>
              </div>
            </div>

            <div class="col-md-12">
              <label for="image" class="label-modal form-label">
                Adicione a imagem do seu livro
              </label>
              <input
                class="form-control"
                type="file"
                accept="image/*"
                @change="(e) => setImage(e)"
                id="image"
              />
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Fechar
          </button>
          <button
            type="button"
            v-on:click="
              () => {
                if (fields.id > 0) {
                  updateBook();
                  return;
                }

                createBook();
              }
            "
            class="btn btn-primary"
          >
            Salvar
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="container container-explore">
    <div class="row">
      <div class="col-md-8">
        <div style="text-align: start">
          <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addBook"
          >
            Adicionar Livro
          </button>
        </div>
      </div>
      <div class="col-md-4">
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

      <div class="col-md-12 container-books" v-if="!loading">
        <div class="row">
          <div class="col-sm-12 col-lg-4 col-md-6 mt-4" v-for="book in books">
            <div
              class="card"
              style="width: 18rem; height: 30.5rem"
              data-bs-theme="dark"
            >
              <img
                :src="
                  book.image && book.image.length > 0
                    ? `data:image/jpeg;base64,${book.image}`
                    : ImgNotFound
                "
                class="card-img-top"
                style="height: 16rem"
                alt="..."
              />
              <div class="card-body d-flex flex-column justify-content-between">
                <div>
                  <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                      <h5 class="card-title">
                        {{ book.title }}
                      </h5>

                      <div v-if="Boolean(book.status)">
                        <span
                          style="
                            position: absolute;
                            margin-top: -3.5rem;
                            margin-left: 2rem;
                          "
                          class="badge text-bg-success d-flex align-items-center"
                          >Lido
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width: 1.5rem; height: 1.5rem"
                            fill="currentColor"
                            class="ms-1 bi bi-check2-all"
                            viewBox="0 0 16 16"
                          >
                            <path
                              d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"
                            />
                            <path
                              d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"
                            />
                          </svg>
                        </span>
                      </div>
                    </div>
                  </div>

                  <p class="card-text">
                    {{ book.author + " - " + book.publication_year }}
                  </p>
                </div>
                <div
                  style="padding: 1rem; text-align: end"
                  v-if="!Boolean(book.status)"
                >
                  <span class="badge text-bg-light mb-1">
                    {{ book.actual_page + "/" + book.number_pages }}</span
                  >

                  <div
                    class="progress"
                    role="progressbar"
                    aria-label="Example with label"
                    :aria-valuenow="
                      'width:' +
                      calculateProgress(book.actual_page, book.number_pages) +
                      '%;'
                    "
                    aria-valuemin="0"
                    aria-valuemax="100"
                  >
                    <div
                      class="progress-bar"
                      :style="
                        'width:' +
                        calculateProgress(book.actual_page, book.number_pages) +
                        '%;'
                      "
                    >
                      {{
                        calculateProgress(book.actual_page, book.number_pages)
                      }}%
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-around">
                  <button
                    class="btn btn-warning me-2"
                    v-on:click="setFieldEdit(book.id)"
                  >
                    Editar
                  </button>
                  <button
                    class="btn btn-danger"
                    v-on:click="deleteBook(book.id)"
                  >
                    Excluir
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from "bootstrap";

import Swal from "sweetalert2";
import LibraryDataService from "../services/LibraryDataService";

export default {
  data() {
    return {
      modal: null,
      valueSearch: "",
      loading: false,
      typingTimer: null,
      books: [],
      fields: {
        id: 0,
        title: "",
        author: "",
        publication_year: 0,
        number_pages: 0,
        actual_page: 0,
        image: null,
        status: 0,
      },
    };
  },
  methods: {
    setFieldEdit(bookId = 0) {
      LibraryDataService.findById(bookId).then((res) => {
        if (res && res.data && res.data.data) {
          this.fields = res.data.data;
          this.modal.show();
        }
      });
    },
    deleteBook(bookId = 0) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success fs-4 me-3",
          cancelButton: "btn btn-danger fs-4",
        },
        buttonsStyling: false,
      });
      swalWithBootstrapButtons
        .fire({
          title: "Certeza Que deseja excluir?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Sim",
          cancelButtonText: "Não",
        })
        .then((result) => {
          if (result.isConfirmed) {
            LibraryDataService.delete(bookId).then((res) => {
              this.getAll();
              if (res && res?.data && res?.data?.success == true) {
                swalWithBootstrapButtons.fire({
                  title: "Deletado!",
                  text: "Livro Deletado com sucesso",
                  icon: "success",
                });
              }
            });
          }
        });
    },
    calculateProgress(page = 0, total = 0) {
      const progress = (page / total) * 100;
      return progress.toFixed(2);
    },
    convertImage() {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = () => {
        this.imageData = reader.result;
      };

      reader.readAsDataURL(file);
    },
    getFields() {
      if (
        this.fields.title == "" ||
        !(this.fields.number_pages > 0) ||
        this.fields.number_pages < this.fields.actual_page
      ) {
        Swal.fire({
          title: "Atenção!",
          text: "Preencha os campos corretamente",
          icon: "warning",
          confirmButtonText: "Fechar",
        });

        return false;
      }

      this.fields.status =
        this.fields.number_pages == this.fields.actual_page
          ? 1
          : Number(this.fields.status);

      var form_data = new FormData();
      for (var key in this.fields) {
        if (key == "id" && this.fields[key] == 0) return;
        form_data.append(key, this.fields[key]);
      }

      return form_data;
    },
    updateBook() {
      let data = this.getFields();
      if (data == false) return;

      try {
        LibraryDataService.updateBook(data, this.fields.id).then((res) => {
          this.getAll();
          Swal.fire({
            title: "Atualizado com sucesso!",
            text: "continue aumentando sua biblioteca",
            icon: "success",
            confirmButtonText: "Fechar",
            didClose: () => {
              this.setDefaultField();
              document.getElementById("close").click();
            },
          });
        });
      } catch (error) {
        this.setDefaultField();
        document.getElementById("close").click();
      }
    },
    createBook() {
      let data = this.getFields();
      if (data == false) return;

      try {
        LibraryDataService.create(data).then((res) => {
          this.getAll();
          Swal.fire({
            title: "Cadastrado com sucesso!",
            text: "continue aumentando sua biblioteca",
            icon: "success",
            confirmButtonText: "Fechar",
            didClose: () => {
              this.setDefaultField();
              document.getElementById("close").click();
            },
          });
        });
      } catch (error) {
        this.setDefaultField();
        document.getElementById("close").click();
      }
    },
    searchBook(value) {
      this.valueSearch = value;
      this.loading = true;
      this.typingTimer !== null && clearTimeout(this.typingTimer);
      this.typingTimer = setTimeout(this.getAll, 600);
    },
    findBySearch(pagination = false) {
      LibraryDataService.findBySearch(
        this.valueSearch,
        pagination ? this.books.length : 0
      ).then((res) => {
        if (!pagination) this.books = [];
        this.setBooks(res.data);
      });
    },
    getAll() {
      LibraryDataService.getAll(this.valueSearch).then((res) => {
        this.setBooks(res.data);
      });
    },
    setBooks(data) {
      if (data && typeof data == "object" && data.hasOwnProperty("data")) {
        this.books = data.data;
        this.loading = false;
      }
    },
    setDefaultField() {
      this.fields = {
        title: "",
        author: "",
        publication_year: 0,
        number_pages: 0,
        actual_page: 0,
        image: null,
        status: 0,
      };
    },
    setImage(event) {
      if (
        event?.target?.files &&
        event.target.files.length > 0 &&
        event.target.files[0] instanceof File
      )
        this.fields.image = event.target.files[0];
    },
  },
  mounted() {
    this.getAll();
    this.modal = new Modal(document.getElementById("addBook"));
  },
};
</script>

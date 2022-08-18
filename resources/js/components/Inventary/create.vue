<template>
  <div class="p-2 text-center">
    <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
      <button class="btn btn-info form-button m-3" type="button" @click="ret()">
        <i class="el-icon-s-fold"></i>
      </button>
      <br />
    </div>
    <div class="d-flex flex-column" id="content-wrapper">
      <div class="table">
        <div class="row">
          <div class="col-lg-12 mb-3">
            <div class="card shadow h-100">
              <div class="card-header">
                <h5
                  v-if="number == 0"
                  class="text-primary m-0 font-weight-bold"
                >
                  Registro de artículo
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar artículo
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de artículo
                </h5>
              </div>
              <div class="card-body">
                <div class="m-2" v-show="number != 2">
                  <el-button
                    v-if="number == 1"
                    type="success"
                    @click="edit()"
                    plain
                    >Guardar todo</el-button
                  >
                  <el-button
                    v-show="number == 0 || number == 3"
                    type="success"
                    @click="edit()"
                    plain
                    >Registrar artículo</el-button
                  >
                </div>
                <div class="m-2" v-show="number == 2">
                  <el-button type="warning" @click="editLink()" plain
                    >Editar</el-button
                  >
                </div>
                <br />
                <form>
                  <div class="row justify-content-left m-0 p-0">
                    <div class="col-12 m-0 p-0 text-left">
                      <strong>Cantidad</strong>
                      <br /><br />
                      <div class="w-100">
                        <input
                          :disabled="number == 2"
                          type="number"
                          name="name"
                          v-model="inventary.quantity"
                          class="form-control mb-2 text-left"
                          placeholder="Ingrese cantidad"
                          required
                        />
                      </div>
                    </div>
                    <br /><br />
                    <div class="col-12 m-0 p-0 text-left">
                      <br />
                      <strong>Nombre</strong>
                      <br /><br />
                      <div class="w-100">
                        <input
                          type="text"
                          name="name"
                          :disabled="number == 2"
                          v-model="inventary.name"
                          class="form-control mb-2 text-left"
                          placeholder="Ingrese Nombre"
                          required
                        />
                      </div>
                    </div>
                    <div class="col-12 m-0 p-0 text-left">
                      <br />
                      <strong>Área</strong>
                      <br /><br />
                      <div class="w-100">
                        <el-select
                          style="width: 100%"
                          v-model="area"
                          filterable
                          placeholder="Seleccione área"
                          :disabled="number == 2"
                        >
                          <el-option
                            v-for="item in areas"
                            :key="item.id"
                            :label="item.name + ': ' + item.place"
                            :value="item.id"
                          >
                          </el-option>
                        </el-select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["number", "detailsid"],
  data() {
    return {
      showId: [],
      response: [],
      editAvailable: false,
      editid: this.detailsid,
      area: null,
      areas: null,
      inventary: {
        id: null,
        quantity: null,
        name: null,
        id_area: null,
      },
    };
  },
  mounted() {
    axios
      .get("/areas/all")
      .then((res) => {
        this.areas = res.data;
        console.log(this.areas);
        if (this.number != 0) {
          axios
            .get(`/inventario/detalleone/${this.editid}`)
            .then((response) => {
              this.inventary = response.data;
              this.area = this.inventary.id_area;
            });
        }
      })
      .catch((error) => {
        this.showErrorNotification(
          "Error al cargar datos",
          "Conexión inválida"
        );
        console.log(error);
      });
  },
  methods: {
    edit() {
      console.log(this.inventary);
      this.inventary.id_area = this.area;
      if (
        this.inventary.name == null ||
        this.inventary.quantity == null ||
        this.inventary.id_area == null
      ) {
        this.showErrorNotification(
          "Agregar inventario",
          "Ingrese todos los campos"
        );
        return;
      }
      axios.post("/inventario", this.inventary).then((response) => {
        if (_.isNumber(response.data.response)) {
          this.editid = response.data.response;
          this.showSuccessNotification(
            "Agregando artículo",
            "Información guardada con éxito"
          );
          if (this.number == 0) {
            this.inventary = {
              id: null,
              quantity: null,
              name: null,
              id_area: null,
            };
            this.area = null;
          }
        } else {
          this.showErrorNotification("Agregando artículo", response.data);
          return;
        }
      });
    },
    showSuccessNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "success",
      });
    },
    showErrorNotification(title, text) {
      this.$notify({
        title: title,
        message: text,
        type: "error",
      });
    },
    editLink() {
      window.location = "/inventario/editar/" + this.editid;
    },
    ret() {
      window.location = "/inventario";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.patient);
    },
  },
};
</script>
<style scoped>
.lbl {
  border: 0;
  outline: 0;
  width: 100%;
  border-bottom: 1px solid black;
}
.dragging {
  opacity: 0.3;
}
label.label input[type="file"] {
  position: absolute;
  top: -1000px;
}
label.label input[type="button"] {
  position: absolute;
  top: -1000px;
}
.label {
  cursor: pointer;
  border: 1px solid #cccccc;
  border-radius: 5px;
  padding: 5px 15px;
  background: white;
  display: inline-block;
}
.label:hover {
  background: rgb(202, 201, 201);
}
.label:active {
  background: #9fa1a0;
}
.label:invalid + span {
  color: #000000;
}
.label:valid + span {
  color: #ffffff;
}
</style>

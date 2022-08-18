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
                  v-if="number == 0 || number == 3"
                  class="text-primary m-0 font-weight-bold"
                >
                  Registro de cirugía
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar cirugía
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de cirugía
                </h5>
              </div>
              <div class="card-body">
                <h5
                  v-if="number != 0"
                  class="text-primary m-0 font-weight-bold"
                >
                  Información del paciente
                </h5>
                <div class="row" v-if="number != 0">
                  <div class="d-inline col-lg-4">
                    <div>
                      <el-button type="info" @click="go()" plain
                        >Ver paciente</el-button
                      >
                    </div>
                    <br />
                    <div>
                      <img
                        id="pic"
                        class="rounded-circle"
                        height="200"
                        width="200"
                      />
                    </div>
                    <br />
                    <div>
                      <el-button type="warning" @click="goedit()" plain
                        >Editar paciente</el-button
                      >
                    </div>
                  </div>
                  <div
                    class="d-inline col-lg-8"
                    v-if="this.cirugy != null && this.cirugy.patient != null"
                  >
                    <div class="d-inline col-lg-8 text-left">
                      <div>
                        <label
                          ><strong>Nombre: </strong
                          >{{ this.cirugy.patient.name }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Dirección: </strong
                          >{{ this.cirugy.patient.address }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Teléfono: </strong
                          >{{ this.cirugy.patient.phone }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Correo: </strong
                          >{{ this.cirugy.patient.email }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>NSS: </strong
                          >{{ this.cirugy.patient.ns }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Peso: </strong
                          >{{ this.cirugy.patient.weight }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Altura: </strong
                          >{{ this.cirugy.patient.height }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Estado: </strong
                          >{{ this.cirugy.patient.status }}</label
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <hr v-if="number != 0" />

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
                    >Registrar cirugía</el-button
                  >
                </div>
                <div class="m-2" v-show="number == 2">
                  <el-button type="warning" @click="editLink()" plain
                    >Editar</el-button
                  >
                </div>
                <h5
                  v-if="number != 0"
                  class="text-primary m-0 font-weight-bold"
                >
                  Información del cirugía
                </h5>
                <form>
                  <br />
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                      <div class="col-md-6 col-xs-12 col-lg-6 m-auto">
                        <label><strong>Fecha</strong></label>

                        <div>
                          <el-date-picker
                            style="width: 100%"
                            v-model="cirugy.dateline"
                            type="datetime"
                            placeholder="Seleccionar"
                            :readonly="number == 2"
                          >
                          </el-date-picker>
                        </div>
                      </div>
                    </div>

                    <div class="d-inline col-lg-6 col-md-6 col-xs-12 mt-4">
                      <div class="form-group">
                        <strong>Paciente</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-select
                            style="width: 100%"
                            v-model="paciente"
                            filterable
                            placeholder="Seleccione"
                            :disabled="number == 2 || number == 3"
                          >
                            <el-option
                              v-for="item in pacientes"
                              :key="item.id"
                              :label="item.name"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12 mt-4">
                      <div class="form-group">
                        <strong>Doctor </strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-select
                            style="width: 100%"
                            v-model="doctor"
                            filterable
                            placeholder="Seleccione"
                            :disabled="number == 2"
                          >
                            <el-option
                              v-for="item in doctores"
                              :key="item.id"
                              :label="item.name"
                              :value="item.id"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group purple-border">
                    <strong>Tipo</strong>
                    <br />
                    <textarea
                      :readonly="number == 2"
                      class="form-control"
                      rows="4"
                      v-model="cirugy.type"
                    ></textarea>
                  </div>
                  <div class="form-group purple-border">
                    <strong>Comentarios</strong>
                    <br />
                    <textarea
                      :readonly="number == 2"
                      class="form-control"
                      rows="8"
                      v-model="cirugy.comments"
                    ></textarea>
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
      paciente: null,
      doctor: null,
      pacientes: [],
      doctores: [],
      files: [],
      array: [],
      showfiles: [],
      isDragging: false,
      dragCount: 0,
      images: [],
      deletefile: [],
      loggeduser: [],
      cirugy: {
        id: null,
        id_patient: null,
        id_doctor: null,
        type: null,
        dateline: null,
        comments: null,
      },
    };
  },
  mounted() {
    axios.get("/pacientes/all").then((response) => {
      this.pacientes = response.data;
      console.log(response.data);
      axios.get("/usuarios/all").then((response) => {
        this.doctores = response.data;
        console.log(response.data);
        axios.get("/usuarios/actual").then((response) => {
          this.loggeduser = response.data;
          console.log(response.data);
          this.doctor = this.loggeduser.id;
          console.log(this.doctor);
          if (this.number == 3) {
            axios
              .get(`/pacientes/detalleone/${this.editid}`)
              .then((response) => {
                this.cirugy.patient = response.data;

                if (this.cirugy.patient.image == null) {
                  document.getElementById("pic").src =
                    "../../../../storage/drop.png";
                } else {
                  document.getElementById("pic").src =
                    "../../../../storage/" + this.cirugy.patient.image;
                }
                this.paciente = this.editid;
              });
          }
          if (this.number != 0 && this.number != 3) {
            axios
              .get(`/cirugias/detalleone/${this.editid}`)
              .then((response) => {
                this.cirugy = response.data;
                if (this.cirugy.patient.image == null) {
                  document.getElementById("pic").src =
                    "../../../../storage/drop.png";
                } else {
                  document.getElementById("pic").src =
                    "../../../../storage/" + this.cirugy.patient.image;
                }
                this.doctor = this.cirugy.id_doctor;
                this.paciente = this.cirugy.id_patient;

                console.log(this.cirugy);
              });
          }
        });
      });
    });
  },
  methods: {
    edit() {
      if (this.doctor == null || this.paciente == null) {
        this.showErrorNotification(
          "Registrar cirugía",
          "Ingrese los campos requeridos"
        );
        return;
      }
      this.cirugy.id_patient = this.paciente;
      this.cirugy.id_doctor = this.doctor;
      axios.post("/cirugias", this.cirugy).then((response) => {
        console.log(this.cirugy);
        if (_.isNumber(response.data.response)) {
          this.showSuccessNotification(
            "Agregando cirugía",
            "Información guardada con éxito"
          );
          if (this.number == 0) {
            this.cirugy = {
              id: null,
              id_patient: null,
              id_doctor: null,
              type: null,
              dateline: null,
              comments: null,
            };
            this.paciente = null;
          }
        } else {
          this.showErrorNotification("Agregando cirugía", response.data);
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
      window.location = "/cirugias/editar/" + this.editid;
    },
    ret() {
      window.location = "/cirugias";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.patient);
    },
    go() {
      window.location = "/pacientes/detalle/" + this.cirugy.patient.id;
    },
    goedit() {
      window.location = "/pacientes/editar/" + this.cirugy.patient.id;
    },
    geturl(dat) {
      return "../../../../storage/" + dat;
    },
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
    getImg(name) {
      let substrings = name.split(".");
      console.log(substrings);
      if (substrings[1] == "pdf") {
        return "../../../../storage/pdf.png";
      }
      if (substrings[1] == "docx" || substrings[1] == "doc") {
        return "../../../../storage/doc.png";
      }
      if (substrings[1] == "png" || substrings[1] == "jpg") {
        return "../../../../storage/img.png";
      }
      if (substrings[1] == "mp3" || substrings[1] == "m4a") {
        return "../../../../storage/mp3.png";
      }
      return "../../../../storage/all.png";
    },
  },
};
</script>
<style scoped>
.dragging {
  opacity: 0.3;
}
input[readonly],
input[readonly="readonly"] {
  background-color: rgb(248, 247, 247);
}
textarea[readonly="readonly"],
textarea[readonly] {
  background-color: rgb(250, 248, 248);
}
.divClass {
  height: 200px;
  overflow-y: scroll;
}
</style>

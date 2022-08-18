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
                  Registro de diagnóstico
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar diagnóstico
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de diagnóstico
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
                    v-if="
                      this.diagnose != null && this.diagnose.patient != null
                    "
                  >
                    <div class="d-inline col-lg-8 text-left">
                      <div>
                        <label
                          ><strong>Nombre: </strong
                          >{{ this.diagnose.patient.name }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Dirección: </strong
                          >{{ this.diagnose.patient.address }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Teléfono: </strong
                          >{{ this.diagnose.patient.phone }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Correo: </strong
                          >{{ this.diagnose.patient.email }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>NSS: </strong
                          >{{ this.diagnose.patient.ns }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Peso: </strong
                          >{{ this.diagnose.patient.weight }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Altura: </strong
                          >{{ this.diagnose.patient.height }}</label
                        >
                      </div>
                      <div>
                        <label
                          ><strong>Estado: </strong
                          >{{ this.diagnose.patient.status }}</label
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
                    >Registrar diagnóstico</el-button
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
                  Información del diagnóstico
                </h5>
                <form>
                  <br />
                  <div class="row">
                    <div
                      v-if="number == 2"
                      class="col-lg-12 col-md-12 col-xs-12 text-center"
                    >
                      <div class="col-md-6 col-xs-12 col-lg-6 m-auto">
                        <label><strong>Fecha</strong></label>

                        <div>
                          <el-date-picker
                            style="width: 100%"
                            v-model="diagnose.updated_at"
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
                    <strong>Enfermedad</strong>
                    <br />
                    <textarea
                      :readonly="number == 2"
                      class="form-control"
                      rows="4"
                      v-model="diagnose.disease"
                    ></textarea>
                  </div>
                  <div class="form-group purple-border">
                    <strong>Descripción</strong>
                    <br />
                    <textarea
                      :readonly="number == 2"
                      class="form-control"
                      rows="8"
                      v-model="diagnose.description"
                    ></textarea>
                  </div>
                  <div class="form-group purple-border">
                    <strong>Tratamiento</strong>
                    <br />
                    <textarea
                      :readonly="number == 2"
                      class="form-control"
                      rows="8"
                      v-model="diagnose.drugs"
                    ></textarea>
                  </div>
                  <div class="form-group purple-border">
                    <strong>Notas</strong>
                    <br />
                    <textarea
                      :readonly="number == 2"
                      class="form-control"
                      rows="5"
                      v-model="diagnose.notes"
                    ></textarea>
                  </div>
                </form>
                <div>
                  <br />
                  <strong>Archivos</strong>
                  <br />
                  <br />
                  <div class="col-md-6 col-lg-5 m-auto" v-if="number != 2">
                    <div class="input-group">
                      <div class="custom-file">
                        <input
                          lang="es"
                          class="custom-file-input"
                          type="file"
                          enctype="multipart/form-data"
                          @change="onInputChange"
                          id="customFile"
                          aria-describedby="inputGroupFileAddon01"
                        />
                        <label
                          class="custom-file-label"
                          for="customFileLangHTML"
                          data-browse="Buscar"
                          >Seleccione</label
                        >
                      </div>
                    </div>
                  </div>
                  <br />
                  <br />
                  <div class="container divClass border border-dark rounded">
                    <div
                      @dragenter="OnDragEnter"
                      @dragleave="OnDragLeave"
                      @dragover.prevent
                      @drop="onDrop"
                      class="row"
                    >
                      <div
                        v-for="(props, index) in files"
                        v-bind:key="index"
                        v-bind:class="props.add == 2 ? 'm-0' : 'm-3'"
                      >
                        <div v-if="props.add != 2">
                          <img
                            width="50px"
                            height="70px"
                            :src="getImg(props.name)"
                            :alt="props.name"
                          />
                          <br />
                          <a
                            :href="geturl(props.ulr_file)"
                            target="_blank"
                            alt="hoal"
                            >{{ truncate(props.name, 15, "...") }}</a
                          >
                          <br />
                          <el-button
                            v-if="number != 2"
                            type="danger"
                            @click="deleteOne(index)"
                            plain
                            >Eliminar</el-button
                          >
                        </div>
                      </div>
                    </div>
                  </div>
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
      diagnose: {
        id: null,
        id_patient: null,
        id_doctor: null,
        disease: null,
        description: null,
        weight: null,
        notes: null,
        drugs: null,
      },
    };
  },
  mounted() {
    axios.get("/pacientes/all").then((response) => {
      this.pacientes = response.data;
      //console.log(response.data);
      axios.get("/usuarios/all").then((response) => {
        this.doctores = response.data;
        //console.log(response.data);
        axios.get("/usuarios/actual").then((response) => {
          this.loggeduser = response.data;
          //console.log(response.data);
          this.doctor = this.loggeduser.id;
          //console.log(this.doctor);
          if (this.number == 3) {
            axios
              .get(`/pacientes/detalleone/${this.editid}`)
              .then((response) => {
                this.diagnose.patient = response.data;

                if (this.diagnose.patient.image == null) {
                  document.getElementById("pic").src =
                    "../../../../storage/drop.png";
                } else {
                  document.getElementById("pic").src =
                    "../../../../storage/" + this.diagnose.patient.image;
                }
                this.paciente = this.editid;
              });
          }
          if (this.number != 0 && this.number != 3) {
            axios
              .get(`/historiales/detalleone/${this.editid}`)
              .then((response) => {
                this.diagnose = response.data;
                this.files = this.diagnose.files;
                this.files.forEach((e) => (e.add = -1));
                this.showfiles = this.files;
                if (this.diagnose.patient.image == null) {
                  document.getElementById("pic").src =
                    "../../../../storage/drop.png";
                } else {
                  document.getElementById("pic").src =
                    "../../../../storage/" + this.diagnose.patient.image;
                }
                this.doctor = this.diagnose.id_doctor;
                this.paciente = this.diagnose.id_patient;

                //console.log(this.diagnose);
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
          "Registrar diagnóstico",
          "Ingrese los campos requeridos"
        );
        return;
      }
      this.diagnose.id_patient = this.paciente;
      this.diagnose.id_doctor = this.doctor;
      axios.post("/historiales", this.diagnose).then((response) => {
        //console.log(this.diagnose);
        if (_.isNumber(response.data.response)) {
          this.showSuccessNotification(
            "Agregando diagnóstico",
            "Información guardada con éxito"
          );
          this.editid=response.data.response;
          this.sendall(response.data.response);
          
          if (this.number == 0) {
            this.diagnose = {
              id: null,
              id_patient: null,
              id_doctor: null,
              disease: null,
              description: null,
              weight: null,
              notes: null,
              drugs: null,
            };
            this.paciente = null;
            this.doctor = this.loggeduser.id;
            this.files = [];
          }
          if (this.number == 3) {
            this.send(this.paciente);
          }
        } else {
          this.showErrorNotification("Agregando diagnóstico", response.data);
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
      window.location = "/historiales/editar/" + this.editid;
    },
    ret() {
      window.location = "/historiales";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      //console.log(this.patient);
    },
    go() {
      window.location = "/pacientes/detalle/" + this.diagnose.patient.id;
    },
    goedit() {
      window.location = "/pacientes/editar/" + this.diagnose.patient.id;
    },
    geturl(dat) {
      return "../../../../storage/" + dat;
    },
    OnDragEnter(e) {
      e.preventDefault();
      this.dragCount++;
      this.isDragging = true;
    },
    OnDragLeave(e) {
      e.preventDefault();
      this.dragCount--;
      if (this.dragCount <= 0) {
        this.isDragging = false;
      }
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();
      this.dragCount = 0;
      this.isDragging = false;
      const files = e.dataTransfer.files;
      Array.from(files).forEach((file) => this.addImage(file));
    },
    onInputChange(e) {
      const files = e.target.files;
      Array.from(files).forEach((file) => this.addImage(file));
      document.getElementById("customFile").value = "";
    },
    addImage(file) {
      var fr = new FileReader();
      var x = this;
      fr.readAsDataURL(file);
      fr.addEventListener(
        "load",
        function () {
        //  //console.log(fr.result);
          let aux = {
            name: file.name,
            id: 0,
            ulr_file: fr.result,
            fileall: file,
            add: 0,
          };
          x.files.push(aux);
        },
        false
      );
    },
    sendall(id) {
      this.files.forEach((value, index) => {
        if (value.fileall != null && value.add==0 && (value.id==null||value.id==0 )) {
          const params = new FormData();
          params.append("imagen", value.fileall);
          params.append("diagnose", id);
          axios.post("/archivos", params).then((response) => {
           // //console.log(response.data);
            if (_.isNumber(response.data)) {
              value.id=response.data;
              this.showSuccessNotification(
                "Agregando archivo",
                "Archivo guardado con éxito"
              );
              
            } else {
              this.showErrorNotification(
                "Agregando archivo",
                "Archivo demasiado pesado"
              );
            }
          });
        }
        console.log(value);
       
        if (value.add == 2 && value.id != null  && value.id!=0) {
          this.deleteImage(value.id);
           console.log("eliminado");
        }
      });
      
    },
    // addImage(file) {
    //   const params = new FormData();
    //   params.append("imagen", file);
    //   params.append("diagnose", this.editid);
    //   axios.post("/archivos", params).then((response) => {
    //     //console.log(response.data);
    //     if (_.isNumber(response.data)) {
    //       this.showSuccessNotification(
    //         "Agregando archivo",
    //         "Archivo guardado con éxito"
    //       );
    //       axios
    //         .get(`/historiales/detalleone/${this.editid}`)
    //         .then((response) => {
    //           this.files = response.data.files;
    //         });
    //     } else {
    //       this.showErrorNotification(
    //         "Agregando archivo",
    //         "Archivo demasiado pesado"
    //       );
    //     }
    //   });
    // },
    deleteOne($idc) {
      // this.deletefile.push(this.files);
      // var index = this.files.findIndex((i) => i.id === $idc);
      //if ($idc != -1) this.files.splice($idc, 1);
      // let x=this.files;
      //.showfiles=this.files;
      //this.showfiles[$idc].add=2;
      this.files[$idc].add = 2;
      this.files.push(this.files[0]);
      this.files.splice(this.files.length - 1, 1);
      //console.log(this.files);
      //this.files=[];
      return;
    },
    deleteImage($idc) {
      // // this.deletefile.push(this.files);
      // // var index = this.files.findIndex((i) => i.id === $idc);
      // //if ($idc != -1) this.files.splice($idc, 1);
      // this.files[$idc].add = 2;
      // return;
      axios
        .delete(`/archivos/${$idc}`)
        .then((response) => {
          if (response.data != 1) {
            this.showErrorNotification(
              "Error al eliminar",
              "Revise la conexión"
            );
          } else {
            this.showSuccessNotification("Eliminar", "Archivo eliminado");
            axios
            .get(`/historiales/detalleone/${this.editid}`)
            .then((response) => {
              this.files = response.data.files;
              this.files.forEach((e) => (e.add = -1));
              
            });
          }
        })
        .catch((error) => {
          this.showErrorNotification("Error al eliminar", "Conexión inválida");
          //console.log(error);
        });
    },
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
    send(patientid) {
      window.location.href = "/pacientes/" + patientid;
    },
    getImg(name) {
      let substrings = name.split(".");
      //console.log(substrings);
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

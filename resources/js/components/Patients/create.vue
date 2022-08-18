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
                  Registro de paciente
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar paciente
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de paciente
                </h5>
              </div>
              <div class="m-2" v-show="number != 2">
                <el-button
                  v-if="number != 0"
                  type="success"
                  @click="edit()"
                  plain
                  >Guardar todo</el-button
                >
                <el-button v-else type="success" @click="edit()" plain
                  >Registrar paciente</el-button
                >
              </div>
              <div class="m-2" v-show="number == 2">
                <el-button type="warning" @click="editLink()" plain
                  >Editar</el-button
                >
              </div>
              <div class="card-body">
                <div class="col-lg-12">
                  <div class="col-lg-12">
                    <div class="text-center">
                      <img
                        @dragenter="OnDragEnter"
                        @dragleave="OnDragLeave"
                        @dragover.prevent
                        @drop="onDrop"
                        id="pic"
                        class="rounded-circle shadow"
                        height="200"
                        width="200"
                        :class="{ dragging: isDragging }"
                      />
                      <br /><br />
                      <div class="col-md-3 col-lg-3 m-auto">
                        <label id="deleteImg" class="label">
                          <input type="button" @click="this.deleteImg" /><span
                            >Eliminar</span
                          ></label
                        >
                      </div>

                      <div
                        class="col-md-3 col-lg-3 m-auto"
                        v-show="number != 2"
                      >
                        <label class="label">
                          <input
                            type="file"
                            enctype="multipart/form-data"
                            @change="onInputChange"
                            class="col-lg-3"
                            id="customFile"
                          />
                          <span>Upload</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <form>
                  <hr />
                  <h5 class="text-primary m-0 font-weight-bold">
                    Información personal
                  </h5>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Nombre</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="name"
                          v-model="patient.name"
                          placeholder="Nombre(s) Apellido(s)"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Dirección</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="address"
                          placeholder="Ejem. Jalisco, Guadalajara, Col. Yañez El verde #89"
                          v-model="patient.address"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>CURP</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="CURP"
                          placeholder="Ejem. FEPM890204HASRRN08"
                          v-model="patient.CURP"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>

                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Teléfono</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="phone"
                          placeholder="Ejem. (+52) 3345234532"
                          v-model="patient.phone"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Ocupación</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="occupation"
                          placeholder="Ejem. Oftalmólogo "
                          v-model="patient.occupation"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Correo electrónico</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="email"
                          placeholder="example@gmail.com"
                          v-model="patient.email"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Género</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div class="row">
                          <div class="d-inline col-md-6">
                            <el-radio
                              v-model="patient.gender"
                              label="0"
                              style="width: 100%"
                              border
                              :disabled="number == 2"
                              >Hombre</el-radio
                            >
                          </div>
                          <div class="d-inline col-md-6">
                            <el-radio
                              style="width: 100%"
                              v-model="patient.gender"
                              label="1"
                              border
                              :disabled="number == 2"
                              >Mujer</el-radio
                            >
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Estado</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-select
                            style="width: 100%"
                            v-model="patient.status"
                            filterable
                            placeholder="Seleccione"
                            :disabled="number == 2"
                          >
                            <el-option
                              v-for="item in vstatus"
                              :key="item.value"
                              :label="item.label"
                              :value="item.value"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Estado civil</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-select
                            style="width: 100%"
                            v-model="patient.marita_status"
                            filterable
                            placeholder="Seleccione"
                            :disabled="number == 2"
                          >
                            <el-option
                              v-for="item in options"
                              :key="item.value"
                              :label="item.label"
                              :value="item.value"
                            >
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="block">
                        <strong>Fecha de nacimiento</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-date-picker
                            style="width: 100%"
                            v-model="patient.birth_date"
                            type="date"
                            placeholder="Seleccionar"
                            :readonly="number == 2"
                          >
                          </el-date-picker>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr />
                  <h5 class="text-primary m-0 font-weight-bold">
                    Información médica
                  </h5>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>NSS</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="ns"
                          placeholder="Número de Seguro Social"
                          v-model="patient.ns"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Peso</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="number"
                          name="weight"
                          step="0.01"
                          placeholder="Kg"
                          v-model="patient.weight"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Altura</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="number"
                          name="height"
                          placeholder="cm"
                          step="0.01"
                          v-model="patient.height"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>

                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Teléfono</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="phone_sec"
                          placeholder="Ejem. (+52) 3323125492"
                          v-model="patient.phone_sec"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div v-if="number != 0" class="container-fluid mt-5">
            <div id="" class="card shadow mb-5">
              <div class="m-0'">
                <div class="card-header py-3">
                  <h5 class="text-primary font-weight-bold">
                    Historial médico
                  </h5>
                </div>
                <div class="card-body">
                  <diagnosepatient-component
                    v-if="this.detailsid != null"
                    v-bind:detailsid="this.detailsid"
                  />
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
      urlactive: "",
      editid: this.detailsid,
      array: [],
      isDragging: false,
      dragCount: 0,
      images: [],
      nuevo: [],
      show: false,
      patient: {
        name: null,
        email: null,
        image: null,
        address: null,
        birth_date: null,
        phone: null,
        ns: null,
        CURP: null,
        gender: null,
        occupation: null,
        marita_status: null,
        weight: null,
        height: null,
        phone_sec: null,
        status: null,
      },
      radio1: "Hombre",
      confirmationp: null,
      options: [
        {
          value: "Soltero",
          label: "Soltero",
        },
        {
          value: "Casado",
          label: "Casado",
        },
        {
          value: "Divorciado",
          label: "Divorciado",
        },
        {
          value: "Separación en proceso judicial",
          label: "Separación en proceso judicial",
        },
        {
          value: "Viudo",
          label: "Viudo",
        },
        {
          value: "Concubinato",
          label: "Concubinato",
        },
      ],
      value: "",
      vstatus: [
        {
          value: "Internado",
          label: "Internado",
        },
        {
          value: "Muerto",
          label: "Muerto",
        },
        {
          value: "En Tratamiento",
          label: "En Tratamiento",
        },
        {
          value: "Dado de alta",
          label: "Dado de alta",
        },
      ],
    };
  },
  mounted() {
    if (this.number != 0) {
      axios.get(`/pacientes/detalleone/${this.editid}`).then((response) => {
        console.log(response.data);

        this.patient = response.data;
        if (this.patient.gender == 1) {
          this.patient.gender = "1";
        } else {
          this.patient.gender = "0";
        }
        if (this.patient.image == null) {
          document.getElementById("pic").src = "../../../../storage/drop.png";
          document.getElementById("deleteImg").style.visibility = "hidden";
        } else {
          document.getElementById("pic").src =
            "../../../../storage/" + this.patient.image;
          if (this.number != 2) {
            document.getElementById("deleteImg").style.visibility = "visible";
          }
        }
      });
    }
    if (this.patient.image == null) {
      document.getElementById("pic").src = "../../../../storage/drop.png";
      document.getElementById("deleteImg").style.visibility = "hidden";
    }
  },
  methods: {
    validate() {
      if (
        !(
          this.patient.name != null &&
          this.patient.address != null &&
          this.patient.CURP != null &&
          this.patient.phone != null &&
          this.patient.gender != null &&
          this.patient.status != null &&
          this.patient.marita_status != null &&
          this.patient.birth_date != null &&
          this.patient.ns != null &&
          this.patient.weight != null &&
          this.patient.height != null &&
          this.patient.phone_sec != null &&
          this.patient.email != null
        )
      ) {
        this.showErrorNotification(
          "Agregando paciente",
          "Complete la información de los campos requeridos"
        );
        return false;
      }
      return true;
    },
    edit() {
      this.patient.role = this.nuevo;
      console.log(this.patient);
      if (this.validate()) {
        axios.post("/pacientes", this.patient).then((response) => {
          if (_.isNumber(response.data.response)) {
            this.editid = response.data.response;
            this.showSuccessNotification(
              "Agregando paciente",
              "Información guardada con éxito"
            );
          } else {
            this.showErrorNotification(
              "Agregando paciente",
              response.data.response
            );
            return;
          }
          console.log(this.editid);
          const params = new FormData();
          let img = document.getElementById("pic");
          if (
            document.getElementById("deleteImg").style.visibility === "visible"
          ) {
            let canvas = document.createElement("canvas");
            canvas.width = img.naturalWidth;
            canvas.height = img.naturalHeight;
            let context = canvas.getContext("2d");
            context.drawImage(img, 0, 0);
            var url = canvas.toDataURL();
            var blobBin = atob(url.split(",")[1]);
            var array = [];
            for (var i = 0; i < blobBin.length; i++) {
              array.push(blobBin.charCodeAt(i));
            }
            var file2 = new Blob([new Uint8Array(array)], {
              type: "image/png",
            });
            params.append("imagen", file2);
            params.append("editImage", this.editid);
          } else if (this.editid != null) {
            params.append("deleteImage", this.editid);
          }
          console.log(params);
          axios.post("/pacientes", params).then((response) => {
            console.log(response);
            if (_.isNumber(response.data)) {
              this.showSuccessNotification(
                "Agregando paciente",
                "Imagen guardada con éxito"
              );
            }
          });
        });
      }
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
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        this.showErrorNotification("Añadir Imagen", "No es una imagen");
        return;
      }
      document.getElementById("deleteImg").style.visibility = "visible";
      var im = document.getElementById("pic");
      document.getElementById("pic").style.visibility = "visible";
      const img = new Image(),
        reader = new FileReader();
      reader.onload = (e) => (im.src = e.target.result);
      reader.readAsDataURL(file);
    },
    deleteImg() {
      document.getElementById("deleteImg").style.visibility = "hidden";
      document.getElementById("pic").src = "../../../../storage/drop.png";
    },
    editLink() {
      window.location = "/pacientes/editar/" + this.editid;
    },
    ret() {
      window.location = "/pacientes";
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
input[readonly],
input[readonly="readonly"] {
  background-color: rgb(248, 247, 247);
}
textarea[readonly="readonly"],
textarea[readonly] {
  background-color: rgb(248, 247, 247);
}
.label:valid + span {
  color: #ffffff;
}
</style>

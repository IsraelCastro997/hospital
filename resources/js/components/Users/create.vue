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
                  Registro de usuario
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar usuario
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de usuario
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
                  >Registrar usuario</el-button
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
                          v-model="user.name"
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
                          v-model="user.address"
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
                          v-model="user.CURP"
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
                          v-model="user.phone"
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
                              v-model="user.gender"
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
                              v-model="user.gender"
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
                            v-model="user.status"
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
                            v-model="user.marita_status"
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
                            v-model="user.birth_date"
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
                          v-model="user.ns"
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
                          v-model="user.weight"
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
                          v-model="user.height"
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
                          v-model="user.phone_sec"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <hr />
                  <h5 class="text-primary m-0 font-weight-bold">
                    Información de Trabajo
                  </h5>
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
                          v-model="user.occupation"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Número de cédula</strong
                        ><input
                          class="form-control"
                          type="certificate_number"
                          name="fathers_name"
                          step="0.01"
                          placeholder="Ingrese número de cédula"
                          v-model="user.cetificate_number"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Salario (Quincena)</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="number"
                          name="salary"
                          step="0.01"
                          placeholder="$"
                          v-model="user.salary"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                  <hr />
                  <h5 class="text-primary m-0 font-weight-bold">
                    Cuenta de usuario
                  </h5>
                  <div class="row">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Correo electrónico</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="text"
                          name="email"
                          placeholder="example@gmail.com"
                          v-model="user.email"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Rol de usuario</strong
                        ><label class="text-danger" v-if="number != 2">
                          *</label
                        >
                        <div>
                          <el-select
                            style="width: 100%"
                            @change="showchange"
                            v-model="nuevo"
                            filterable
                            placeholder="Seleccione"
                            :disabled="number == 2"
                          >
                            <el-option
                              v-for="item in roles"
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
                  <el-button
                    v-if="number == 1"
                    type="warning"
                    plain
                    @click="addShow"
                    >Cambiar contraseña</el-button
                  >
                  <div class="row" v-show="number == 0 || show == true">
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Nueva contraseña</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="password"
                          name="password"
                          step="0.01"
                          v-model="user.password"
                          placeholder="Ingrese contraseña"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                    <div class="d-inline col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <strong>Confirmar contraseña</strong
                        ><label class="text-danger" v-if="number != 2"> *</label
                        ><input
                          class="form-control"
                          type="password"
                          name="passwordtwo"
                          step="0.01"
                          placeholder="Reingrese contraseña"
                          v-model="confirmationp"
                          :readonly="number == 2"
                        />
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="number != 0" class="container-fluid mt-5">
        <div id="" class="card shadow mb-5">
          <div class="m-0'">
            <div class="card-header py-3">
              <h5 class="text-primary font-weight-bold">Horario</h5>
            </div>
            <div class="card-body">
              <scheduleuser-component
                v-if="this.detailsid != null"
                v-bind:userselected="this.detailsid"
              />
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
      roles: [],
      editid: this.detailsid,
      array: [],
      isDragging: false,
      dragCount: 0,
      images: [],
      nuevo: [],
      show: false,
      user: {
        name: null,
        email: null,
        image: null,
        address: null,
        birth_date: null,
        phone: null,
        role: null,
        ns: null,
        CURP: null,
        gender: null,
        occupation: null,
        marita_status: null,
        weight: null,
        height: null,
        phone_sec: null,
        status: null,
        cetificate_number: null,
        salary: null,
        password: null,
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
          value: "Activo",
          label: "Activo",
        },
        {
          value: "Despedido",
          label: "Despedido",
        },
        {
          value: "Retirado",
          label: "Retirado",
        },
      ],
    };
  },
  mounted() {
    axios.get("/roles").then((res) => {
      this.roles = res.data;
      console.log(this.roles);
      if (this.number != 0) {
        axios.get(`/usuarios/detalleone/${this.editid}`).then((response) => {
          console.log(response.data);

          this.user = response.data;
          this.nuevo =
            this.user.roles.length > 0 ? this.user.roles[0].id : null;
          if (this.user.gender == 1) {
            this.user.gender = "1";
          } else {
            this.user.gender = "0";
          }
          if (this.user.image == null) {
            document.getElementById("pic").src = "../../../../storage/drop.png";
            document.getElementById("deleteImg").style.visibility = "hidden";
          } else {
            document.getElementById("pic").src =
              "../../../../storage/" + this.user.image;
            if (this.number != 2) {
              document.getElementById("deleteImg").style.visibility = "visible";
            }
          }
        });
      }
      if (this.user.image == null) {
        document.getElementById("pic").src = "../../../../storage/drop.png";
        document.getElementById("deleteImg").style.visibility = "hidden";
      }
    });
  },
  methods: {
    validate() {
      if (
        !(
          this.user.name != null &&
          this.user.address != null &&
          this.user.CURP != null &&
          this.user.phone != null &&
          this.user.gender != null &&
          this.user.status != null &&
          this.user.marita_status != null &&
          this.user.birth_date != null &&
          this.user.ns != null &&
          this.user.weight != null &&
          this.user.height != null &&
          this.user.phone_sec != null &&
          this.user.occupation != null &&
          this.user.salary != null &&
          this.user.email != null &&
          this.nuevo != null &&
          (this.show == false ||
            (this.user.password != null && this.confirmationp != null))
        )
      ) {
        this.showErrorNotification(
          "Agregando usuario",
          "Complete la información de los campos requeridos"
        );
        return false;
      }
      if (
        this.show == true &&
        (this.user.password == null || this.confirmationp == null)
      ) {
        this.showErrorNotification(
          "Agregando usuario",
          "Ingrese una contraseña"
        );
        return false;
      }
      if (this.show == true && this.user.password != this.confirmationp) {
        this.showErrorNotification(
          "Agregando usuario",
          "Las contraseñas no coinciden"
        );
        return false;
      }
      return true;
    },
    edit() {
      this.user.role = this.nuevo;
      console.log(this.user);
      if (this.validate()) {
        axios.post("/usuarios", this.user).then((response) => {
          if (_.isNumber(response.data.response)) {
            this.editid = response.data.response;
            this.showSuccessNotification(
              "Agregando usuario",
              "Información guardada con éxito"
            );
          } else {
            this.showErrorNotification(
              "Agregando usuario",
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
          axios.post("/usuarios", params).then((response) => {
            console.log(response);
            if (_.isNumber(response.data)) {
              this.showSuccessNotification(
                "Agregando usuario",
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
      window.location = "/usuarios/editar/" + this.editid;
    },
    ret() {
      window.location = "/usuarios";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.user);
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

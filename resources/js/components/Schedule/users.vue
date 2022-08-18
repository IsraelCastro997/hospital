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
              <div class="card-header mb-3">
                <h5 class="text-primary m-0 font-weight-bold">
                  Asignación de horario
                </h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-xs-12 col-md-8 mt-3">
                    <el-button type="success" size="medium" @click="edit" plain
                      >Guardar</el-button
                    >
                  </div>
                  <div class="col-lg-6 col-xs-12 col-md-8 mt-3">
                    <el-button
                      type="warning"
                      size="medium"
                      @click="updateuser"
                      plain
                      >Mostrar original</el-button
                    >
                  </div>
                </div>
                <div class="mt-3 mb-3 row">
                  <div class="col-xl-12 mb-3">
                    <strong class="h5">Asignar horarios</strong>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                    <strong>Seleccione usuario</strong>
                    <el-select
                      style="width: 100%"
                      v-model="userselected"
                      filterable
                      placeholder="Seleccione usuario"
                      :disabled="this.detailsid != null && this.detailsid != 0"
                      @change="updateuser"
                    >
                      <el-option
                        v-for="item in users"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                      >
                      </el-option>
                    </el-select>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                    <strong>Seleccione horario</strong>
                    <el-select
                      style="width: 100%"
                      v-model="selected"
                      filterable
                      placeholder="Seleccione horario"
                      @change="update()"
                    >
                      <el-option
                        v-for="item in data"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                      >
                      </el-option>
                    </el-select>
                  </div>
                </div>
                <div v-if="this.scheduledata != null">
                  <h5 class="text-primary m-0 font-weight-bold mb-3">
                    Información del horario
                  </h5>
                  <el-button
                    type="warning"
                    size="medium"
                    @click="editone(scheduledata.id)"
                    plain
                    >Editar horario</el-button
                  >
                  <div class="row mt-2">
                    <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                      <strong>Nombre</strong>
                      <input
                        class="form-control"
                        type="text"
                        name="name"
                        v-model="scheduledata.name"
                        placeholder="----------------"
                        :readonly="number == 2"
                      />
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                      <strong>Área</strong>
                      <el-select
                        style="width: 100%"
                        v-model="area"
                        filterable
                        placeholder="Seleccione área"
                        :disabled="this.number == 2"
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
                    <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                      <strong>Fecha de inicio</strong>
                      <el-date-picker
                        style="width: 100%"
                        v-model="scheduledata.start_date"
                        type="date"
                        placeholder="Fecha inicio"
                        :readonly="number == 2"
                      >
                      </el-date-picker>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                      <strong>Fecha de fin</strong>
                      <el-date-picker
                        style="width: 100%"
                        v-model="scheduledata.end_date"
                        type="date"
                        placeholder="Fecha fin"
                        :readonly="number == 2"
                      >
                        >
                      </el-date-picker>
                    </div>
                  </div>

                  <div class="table-responsive table mt-2" role="grid">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="w-25">Día</th>
                          <th>Horario</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(day, name, index) in schedule"
                          v-bind:key="name"
                        >
                          <td class="w-25">{{ name }}</td>
                          <td>
                            <div class="text-center">
                              <div
                                class="
                                  border border-dark
                                  rounded
                                  text-right
                                  col-lg-8
                                  ml-auto
                                  mr-auto
                                  mb-1
                                "
                                v-for="(props, index2) in day"
                                v-bind:key="index2"
                                :style="
                                  'background-color:' +
                                  getRandomColor(index + index2)
                                "
                              >
                                <label class="text-center">{{ props }}</label
                                ><span
                                  class="btn text-right"
                                  @click="onClickDelete(name, index2)"
                                >
                                  <i class="el-icon-close"></i>
                                </span>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>

                      <tbody></tbody>
                      <tfoot>
                        <tr>
                          <th>Día</th>
                          <th>Horario</th>
                        </tr>
                      </tfoot>
                    </table>
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
  props: ["detailsid"],
  data() {
    return {
      data: [],
      selected: null,
      users: null,
      userselected: null,
      schedule: [],
      area: null,
      areas: null,
      number: 2,
      scheduledata: null,
      urlactive: "",
    };
  },
  mounted() {
    axios
      .get("/areas/all")
      .then((res) => {
        this.areas = res.data;
        console.log(this.areas);
        axios
          .get("/horarios/all")
          .then((res) => {
            console.log(res.data);
            this.data = res.data;
            axios
              .get("/usuarios/all")
              .then((res) => {
                console.log(res.data);
                this.users = res.data;
                if (this.detailsid != null && this.detailsid != 0) {
                  this.userselected = this.detailsid;
                }
                this.updateuser();
              })
              .catch((error) => {
                this.showErrorNotification(
                  "Error al cargar datos",
                  "Conexión inválida"
                );
                console.log(error);
              });
          })
          .catch((error) => {
            this.showErrorNotification(
              "Error al cargar datos",
              "Conexión inválida"
            );
            console.log(error);
          });
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
      if (this.userselected == null || this.selected == null) {
        this.showErrorNotification(
          "Asignar",
          "Ingrese el usuario y el horario"
        );
        return;
      }
      var d = {
        id_schedule: this.selected,
      };
      axios
        .patch(`/usuarios/${this.userselected}`, d)
        .then((response) => {
          this.showSuccessNotification(
            "Asignando",
            "El horario ha sido asignado"
          );
          axios
            .get("/usuarios/all")
            .then((res) => {
              console.log(res.data);
              this.users = res.data;
            })
            .catch((error) => {
              this.showErrorNotification(
                "Error al cargar datos",
                "Conexión inválida"
              );
              console.log(error);
            });
        })
        .catch((error) => {
          this.showErrorNotification(
            "Error al cargar datos",
            "Conexión inválida"
          );
          console.log(error);
        });
    },
    editLink() {},
    update() {
      console.log();
      var index = this.data.findIndex((i) => i.id === this.selected);
      if (index != -1) {
        this.schedule = JSON.parse(this.data[index].all_schedule);
        this.scheduledata = this.data[index];
        this.area = this.scheduledata.id_area;
      }
    },
    getRandomColor(indx) {
      indx = (indx + indx * 3) * (indx + 5 * indx * indx * indx) * indx + indx;
      var letters = "0123456789ABCDEF";
      var color = "#";
      var x = String.fromCharCode(65 + (indx % 6));
      var d = x + indx.toString();
      color += d;
      for (var i = 0; i < 6 - d.length; i++) {
        color += String.fromCharCode(
          65 + ((i * i * i * +i * 20 * 7 + indx * indx + 34 * indx * indx) % 6)
        );
      }
      color = color.slice(0, 7);
      return color + 30;
    },
    updateuser() {
      var index = this.users.findIndex((i) => i.id === this.userselected);
      if (index != -1) this.selected = this.users[index].id_schedule;
      this.update();
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
    ret() {
      window.location.href = "/horarios";
    },
    editone($id) {
      window.location.href = "/horarios/editar/" + $id;
    },
  },
};
</script>

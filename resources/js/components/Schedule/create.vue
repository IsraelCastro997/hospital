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
                <h5
                  v-if="number == 0"
                  class="text-primary m-0 font-weight-bold"
                >
                  Registro de horario
                </h5>
                <h5
                  v-if="number == 1"
                  class="text-primary m-0 font-weight-bold"
                >
                  Editar horario
                </h5>
                <h5
                  v-if="number == 2"
                  class="text-primary m-0 font-weight-bold"
                >
                  Detalles de horario
                </h5>
              </div>
              <div class="card-body">
                <div class="col-lg-6 col-xs-8 m-auto" v-show="number != 2">
                  <el-button type="success" @click="edit" plain
                    >Guardar</el-button
                  >
                </div>
                <div v-show="number == 2" class="col-lg-6 col-xs-8 m-auto">
                  <el-button type="warning" @click="editLink" plain
                    >Editar</el-button
                  >
                </div>
                <div class="row mt-5">
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
                    <input
                      class="form-control"
                      type="text"
                      name="name"
                      v-model="scheduledata.name"
                      placeholder="Nombre (Ej. Medio tiempo)"
                      :disabled="number == 2"
                    />
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
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
                  <div class="col-lg-6 col-md-6 col-xs-8 mb-2">
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
                <div class="mt-3 mb-3 row" v-show="number != 2">
                  <div class="col-xl-12 mb-3">
                    <strong class="h5">Agregar nueva hora</strong>
                  </div>

                  <div class="col-lg-4 col-md-8 col-xs-12 mb-2">
                    <el-select
                      style="width: 100%"
                      v-model="day_selected"
                      filterable
                      placeholder="Día"
                    >
                      <el-option
                        v-for="item in all_days"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value"
                      >
                      </el-option>
                    </el-select>
                  </div>
                  <div class="col-lg-4 col-md-8 col-xs-12 mb-2">
                    <el-time-select
                      style="width: 100%"
                      placeholder="Hora inicio"
                      v-model="startTime"
                      @change="changed()"
                      :picker-options="{
                        start: '00:00',
                        step: '00:30',
                        end: '23:59',
                      }"
                    >
                    </el-time-select>
                  </div>
                  <div class="col-lg-4 col-md-8 col-xs-12 mb-2">
                    <el-time-select
                      placeholder="Hora fin"
                      style="width: 100%"
                      v-model="endTime"
                      :picker-options="{
                        start: '00:00',
                        step: '00:30',
                        end: '23:59',
                        minTime: startTime,
                      }"
                    >
                    </el-time-select>
                  </div>
                </div>
                <el-button
                  v-show="number != 2"
                  class="mb-2"
                  type="primary"
                  plain
                  @click="addHour()"
                  >Agregar</el-button
                >

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
                                v-show="number != 2"
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
</template>
<script>
export default {
  props: ["number", "detailsid"],
  data() {
    return {
      showId: [],
      startTime: null,
      endTime: null,
      area: null,
      areas: null,
      name: null,
      response: [],
      day_selected: null,
      scheduledata: {
        id: null,
        name: null,
        all_schedule: null,
        id_area: null,
        start_date: null,
        end_date: null,
      },
      all_days: [
        {
          value: "Lunes",
          label: "Lunes",
        },
        {
          value: "Martes",
          label: "Martes",
        },
        {
          value: "Miércoles",
          label: "Miércoles",
        },
        {
          value: "Jueves",
          label: "Jueves",
        },
        {
          value: "Viernes",
          label: "Viernes",
        },
        {
          value: "Sábado",
          label: "Sábado",
        },
        {
          value: "Domingo",
          label: "Domingo",
        },
      ],
      editAvailable: false,
      editid: this.detailsid,
      schedule: {
        Lunes: [],
        Martes: [],
        Miércoles: [],
        Jueves: [],
        Viernes: [],
        Sábado: [],
        Domingo: [],
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
          axios.get(`/horarios/detalleone/${this.editid}`).then((response) => {
            this.scheduledata = response.data;
            console.log(this.scheduledata);

            this.area = this.scheduledata.id_area;
            if (this.scheduledata.all_schedule != null)
              this.schedule = JSON.parse(this.scheduledata.all_schedule);
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
      const myJSON = JSON.stringify(this.schedule);
      console.log(myJSON);
      this.scheduledata.all_schedule = myJSON;
      this.scheduledata.id_area = this.area;
      console.log(this.scheduledata);
      if (
        this.scheduledata.id_area == null ||
        this.scheduledata.name == null ||
        this.scheduledata.start_date == null ||
        this.scheduledata.end_date == null
      ) {
        this.showErrorNotification(
          "Agregar horario",
          "Ingrese todos los campos"
        );
        return;
      }
      axios.post("/horarios", this.scheduledata).then((response) => {
        if (_.isNumber(response.data.response)) {
          this.editid = response.data.response;
          this.showSuccessNotification(
            "Agregando horario",
            "Información guardada con éxito"
          );
        } else {
          this.showErrorNotification("Agregando horario", response.data);
          return;
        }
      });
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
      window.location = "/horarios/editar/" + this.editid;
    },
    ret() {
      window.location = "/horarios";
    },
    addShow() {
      this.show = true;
    },
    showchange() {
      console.log(this.patient);
    },
    addHour() {
      if (
        this.day_selected != null &&
        this.startTime != null &&
        this.endTime != null
      ) {
        console.log(this.day_selected);
        console.log(this.startTime);
        console.log(this.endTime);
        var str = this.startTime.toString();
        var str2 = this.endTime.toString();
        this.schedule[this.day_selected].push(str + "-" + str2);
        this.schedule[this.day_selected].sort();
      }
    },
    onClickDelete(name, index) {
      this.schedule[name].splice(index, 1);
    },
    changed() {
      console.log("hol");
      this.endTime = null;
    },
  },
};
</script>

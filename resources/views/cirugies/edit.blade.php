@extends('layouts.app')

@section('content')

<template>
    <div class="p-2 text-center">
      <div class="col-sm-4 col-lg-2 text-left m-0 p-0">
        <button class="btn btn-info form-button m-3" type="button">
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
                   
                    class="text-primary m-0 font-weight-bold"
                  >
                    Registro de diagnóstico
                  </h5>
                  <h5
                   
                    class="text-primary m-0 font-weight-bold"
                  >
                    Editar diagnóstico
                  </h5>
                  <h5
                  
                    class="text-primary m-0 font-weight-bold"
                  >
                    Detalles de diagnóstico
                  </h5>
                </div>
                <div class="card-body">
                  <h5
                   
                    class="text-primary m-0 font-weight-bold"
                  >
                    Información del paciente
                  </h5>
                  <div class="row" >
                    <div class="d-inline col-lg-4">
                      <div>
                       
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
                       
                      </div>
                    </div>
                    <div class="d-inline col-lg-8">
                      <div class="d-inline col-lg-8 text-left">
                        <div>
                          <label
                            ><strong>Nombre: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>Dirección: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>Teléfono: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>Correo: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>NSS: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>Peso: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>Altura: </strong
                            ></label
                          >
                        </div>
                        <div>
                          <label
                            ><strong>Estado: </strong
                            ></label
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr  />
  
                  <div class="m-2">
                   

                   
                  </div>
                  <div class="m-2" >
                  
                  </div>
                  <h5
                 
                    class="text-primary m-0 font-weight-bold"
                  >
                    Información del diagnóstico
                  </h5>


                <form action="{{ url('cirugias/edit/'. $cirugia->id) }}" method="POST" > @csrf
                  <input type="submit" class="btn btn-success" value="Editar cirugia">
                  <br />
                  <div class="row">
                    <div
                     
                      class="col-lg-12 col-md-12 col-xs-12 text-center"
                    >
                      <div class="col-md-6 col-xs-12 col-lg-6 m-auto">
                        <label><strong>Fecha</strong></label>

                        <div>
                            <input type="datetime-local" name="dateline" id="dateline">
                        </div>
                      </div>
                    </div>

                    <div class="d-inline col-lg-6 col-md-6 col-xs-12 mt-4">
                      <div class="form-group">
                        <strong>Paciente</strong><label class="text-danger" >*</label>
                        <select name="paciente" id="paciente">
                            @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->name }}</option>
                            @endforeach
                         
                      </select>
                       
                        </div>
                      </div>
                      <div class="d-inline col-lg-6 col-md-6 col-xs-12 mt-4">
                          <div class="form-group">
                            <strong>Doctor </strong><label class="text-danger" >*</label>
                               
                              <select name="doctor" id="doctor">
                                @foreach ($doctores as $doctor)
                                  <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                  @endforeach
                                 
                              </select>
                          </div>
                        </div>
                    </div>
                   
                  

                  <div class="form-group purple-border">
                    <strong>Tipo</strong>
                    <br/>
                    <input type="text" name="type" id="type" class="form-control" value="{{ $cirugia->type }}">
                  </div>

                  <div class="form-group purple-border">
                    <strong>Comentarios</strong>
                    <br />
                    <input type="text" name="comments" id="comments"class="form-control" rows="8"  value="{{ $cirugia->comments }}">
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

  
  @endsection
  <style>
  .dragging {
    opacity: 0.3;
  }
  input
 {
    background-color: rgb(248, 247, 247);
  }
  textarea{
    background-color: rgb(250, 248, 248);
  }
  .divClass {
    height: 200px;
    overflow-y: scroll;
  }
  </style>
  
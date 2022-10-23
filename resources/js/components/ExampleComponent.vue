<template>
    <div class="container">
           
    <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <button type="button" class="btn btn-info" style="float: right;" v-on:click="nuevo_cliente">
 Agregar
</button>
              <h3 class="text-white mb-0">Lista de usuarios</h3>
            </div>
            <div class="table-responsive" id="v-for-object" >
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">



   
             
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nombre</th>
                    <th scope="col" class="sort" data-sort="budget">Apellido </th>
                    <th scope="col" class="sort" data-sort="status">Teléfono</th>
                     <th scope="col" class="sort" data-sort="status">Dirección</th>
                     <th scope="col" class="sort" data-sort="status">Email</th>
                     <th scope="col" class="sort" data-sort="status">Acciones</th>
                  </tr>
                </thead>
                <tbody class="list" id="v-for-object">
                <tr  v-for="cliente in clientes"> 
                        <td>{{cliente.nombre_cliente}}</td>
                        <td>{{cliente.apaterno_cliente}}</td>

                        <td>{{cliente.telefono_cliente}}</td>
                         <td>{{cliente.direccion_cliente}}</td>
                         
                            <td>{{cliente.correo_cliente}}</td>


                  <td>
                            <form>
                                 <button type="button" class="btn btn-warning" v-on:click="asignaCliente(cliente)">Editar</button>
                              <button type="button" class="btn btn-danger" v-on:click="eliminar_cliente(cliente)" >Eliminar</button>
</form>

</td>

</tr>
             
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos Cliente</h5>
            <button type="button" class="close" v-on:click="cerrarModal"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="alert alert-default" role="alert">
                <strong>  </strong> {{error}}
            </div>

            <form>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" v-model="cliente_modal.nombre_cliente" class="form-control" id="nombre_cliente">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Apellido paterno:</label>
                        <input type="text" v-model="cliente_modal.apaterno_cliente" class="form-control" id="apaterno_cliente">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Apellido materno:</label>
                        <input type="text"  v-model="cliente_modal.amaterno_liente"  class="form-control" id="amaterno_liente">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Edad:</label>
                        <input type="text"  v-model="cliente_modal.edad_cliente"  class="form-control" id="edad_cliente">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" v-model="cliente_modal.telefono_cliente" class="form-control" id="telefono_cliente">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" v-model="cliente_modal.direccion_cliente" class="form-control" id="direccion_cliente">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Email:</label>
                        <input type="text" v-model="cliente_modal.correo_cliente" class="form-control" id="correo_cliente">
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" v-on:click="cerrarModal">Cerrar</button>
           <button type="button"  class="btn btn-success" v-on:click="guardar_clientes">Guardar</button>
          
         </div>
      </div>
   </div>
</div>






      
</div>
    
</template>

<script>
    export default {
        data(){
            return{
            clientes: {},
            cliente_modal: {},
            error: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.obtener_clientes()
        },
        methods: {
          obtener_clientes(){
              console.log('Obteniendo clientes')

              axios.get('clientes/lista')
              .then((response) => {
                  this.clientes = response.data
                  console.log(response.data)
              })
              .catch((error) => {
                  console.log(error.data)
              })
          },
          guardar_clientes(){
              console.log('Guardando clientes')

              axios.post('api/cliente/guardar', this.cliente_modal)
              .then((response) => {
                  console.log(response.data)
                  this.abreCierraModal()
                  this.obtener_clientes()
              })
              .catch((error) => {
                  console.log(error.data)
              })
          },
          abreCierraModal(){
                $('#exampleModal').modal('toggle')
          },
          cerrarModal(){
                $('#exampleModal').modal('hide')
          },
          asignaCliente(cliente){
            this.cliente_modal = cliente
            this.abreCierraModal()
          },
          editaCliente(){

              axios.post('api/cliente/guardar', this.cliente_modal)
              .then((response) => {
                  console.log(response.data)
                  this.abreCierraModal()
                  this.obtener_clientes()
              })
              .catch((error) => {
                  console.log(error.data)
              })

          },
          nuevo_cliente(){
              this.cliente_modal = {}
              this.abreCierraModal()
          },
            eliminar_cliente(cliente){
              console.log('cliente Eliminado')

              axios.post('api/cliente/eliminar',cliente)
              .then((response) => {
                  console.log(response.data)
                  this.obtener_clientes()
              })
              .catch((error) => {
                  console.log(error.data)
              })
          }
        }
    }
</script>

<template>
    <div class="container">
           
    <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <button type="button" class="btn btn-info" style="float: right;" v-on:click="nueva_venta">
 Agregar
</button>
              <h3 class="text-white mb-0">Lista de usuarios</h3>
            </div>
            <div class="table-responsive" id="v-for-object" >
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">

                  <tr>
                    <th scope="col" class="sort" data-sort="name">Venta</th>
                    <th scope="col" class="sort" data-sort="status">Cantidad</th>
                     <th scope="col" class="sort" data-sort="status">Precio</th>
                     <th scope="col" class="sort" data-sort="status">Acciones</th>
                    
                  </tr>
                  
                </thead>
                <tbody class="list" id="v-for-object">
                <tr  v-for="detalle in detalles"> 
                        <!-- <td>{{detalle.id}}</td> -->
                         <td>{{detalle.ventas_id}}</td>
                        <td>{{detalle.cantidad_ventas}}</td>
                        <td>{{detalle.precio_ventas}}</td>
                         


                  <td>
                            <form>
                                 <button type="button" class="btn btn-warning" v-on:click="asignaDetalles(detalle)">Editar</button>
                              <button type="button" class="btn btn-danger" v-on:click="eliminar_detalle(detalle)" >Eliminar</button>
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
                        <label>Selecciona la venta :</label>
                       
                        <select name="id_venta" v-model="detalle_modal.ventas_id" id="ventas_id" class="form-control" >
                        
                        <option v-for="venta in ventas" v-bind:key="venta.id" v-bind:value="venta.id">{{venta.id}}</option>
                         
                        </select>
                        
          
                     </div>
                  </div>
                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Nombre Producto:</label>
                       
                        <select  name="productos_id" v-model="detalle_modal.productos_id" id="productos_id" class="form-control" >
                        
                        <option v-for="producto in productos" v-bind:key="producto.id" v-bind:value="producto.id">{{producto.nombre_producto}}</option> 
                         
                        </select>
                        
          
                     </div>
                  </div> 

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" v-model="detalle_modal.cantidad_ventas" class="form-control" id="cantidad_ventas">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Precio:</label>
                        <input type="text"  v-model="detalle_modal.precio_ventas"  class="form-control" id="precio_ventas">
                     </div>
                  </div>
                  
                  
                 
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" v-on:click="cerrarModal">Cerrar</button>
           <button type="button"  class="btn btn-success" v-on:click="guardar_detalles">Guardar</button>
          
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
            ventas:{},
            clientes: {},
            productos: {},
            detalles: {},
            detalle_modal: {},
            error: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.obtener_clientes()
            this.obtener_ventas()
            this.obtener_detalles()
            this.obtener_productos()

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
          obtener_productos(){
              console.log('Obteniendo productos')

              axios.get('productos/lista')
              .then((response) => {
                  this.productos = response.data
                  console.log(response.data)
              })
              .catch((error) => {
                  console.log(error.data)
              })
          },
          obtener_ventas(){
              console.log('Obteniendo ventas')

              axios.get('ventas/lista')
              .then((response) => {
                  this.ventas = response.data
                  console.log(response.data)
              })
              .catch((error) => {
                  console.log(error.data)
              })
          },
          obtener_detalles(){
              console.log('Obteniendo detalles')

              axios.get('detalles/lista')
              .then((response) => {
                  this.detalles = response.data
                  console.log(response.data)
              })
              .catch((error) => {
                  console.log(error.data)
              })
          },
         
          guardar_detalles(){
              console.log('Guardando productos')
              var form = new FormData()
              if(this.detalle_modal.id != undefined)
              form.append('id', this.detalle_modal.id)
               form.append('ventas_id', this.detalle_modal.ventas_id)
               form.append('productos_id', this.detalle_modal.productos_id)
              form.append('cantidad_ventas', this.detalle_modal.cantidad_ventas)
              form.append('precio_ventas', this.detalle_modal.precio_ventas)

              axios.post('api/detalle/guardar', this.detalle_modal)
              .then((response) => {
                  console.log(response.data)
                  this.abreCierraModal()
                  this.obtener_detalles()
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
          asignaDetalles(detalle){
            this.detalle_modal= detalle
            this.abreCierraModal()
          },
          
         
          nueva_venta(){
              this.detalle_modal = {}
              this.abreCierraModal()
          },

            eliminar_detalle(detalle){
              console.log('detalles Eliminado')

              axios.post('api/detalle/eliminar',detalle)
              .then((response) => {
                  console.log(response.data)
                  this.obtener_detalles()
              })
              .catch((error) => {
                  console.log(error.data)
              })
          }
        }
    }
</script>

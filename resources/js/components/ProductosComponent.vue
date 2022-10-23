<template>
    <div class="container">
     
    <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                    <button type="button" class="btn btn-info"  style="float: right;" v-on:click="nuevo_producto">
                     Agregar
                     </button>
              <h3 class="text-white mb-0">Lista de Productos</h3>
               
            </div>
            <div class="table-responsive" id="v-for-object" >
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">



   
             
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nombre del producto</th>
                    <th scope="col" class="sort" data-sort="budget">Precio</th>
                     <th scope="col" class="sort" data-sort="budget">detalle</th>
                    <th scope="col" class="sort" data-sort="budget">stock</th>
                     <th scope="col" class="sort" data-sort="budget">área</th>
                   
                   
                    <th scope="col" class="sort" data-sort="status">Foto</th>
                      
                     <th scope="col" class="sort" data-sort="status">Acciones</th>
                  </tr>
                </thead>
                <tbody class="list" id="v-for-object">
                         <tr  v-for="producto in productos"> 
                    
                        <td>{{producto.nombre_producto}}</td>
                        <td>{{producto.precio_producto}}</td>
                        <td>{{producto.detalle_producto}}</td>
                        <td>{{producto.stock_producto}}</td>
                        <td>{{producto.area_producto}}</td>
                       
                        <td>
                        
                        <img  v-if="producto.foto_producto" :src="producto.foto_producto.replace('public/','storage/')"  height="100px">
                        
                        </td>


                  <td>
                            <form>
                                 <button type="button" class="btn btn-warning" v-on:click="asignaProducto(producto)">Editar</button>
                              <button type="button" class="btn btn-danger" v-on:click="eliminar_producto(producto)" >Eliminar</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Datos Producto</h5>
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
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Nombre producto:</label>
                        <input type="text" v-model="producto_modal.nombre_producto" class="form-control" id="nombre_producto">
                     </div>
                  </div>

                    <div class="col-md-6">
                  <div class="form-group">
                  
                        <label>Detalle:</label>
                        <input type="text" v-model="producto_modal.detalle_producto" class="form-control" id="detalle_producto">
                     </div>
                     </div>


                      <div class="col-md-6">
                    <div class="form-group">
                        <label>Área:</label>
                        <input type="text" v-model="producto_modal.area_producto" class="form-control" id="area_producto">
                     </div>
                    </div>

                       <div class="col-md-6">

                     <div class="form-group">
                        <label>Precio:</label>
                        <input type="text" v-model="producto_modal.precio_producto" class="form-control" id="precio_producto">
                     </div>

                     </div>


                      <div class="col-md-6">
                     <div class="form-group">
                        <label>stock:</label>
                        <input type="text" v-model="producto_modal.stock_producto" class="form-control" id="stock_producto">
                     </div>
                     </div> 

                  <div class="row">
                  <div class="col-md-10">
                      <input ref="upload"
                                type="file"
                                name="file-upload"
                                multiple=""
                                accept="image/jpeg, image/png"
                                @change="asignaArchivo">  
                  </div>
                   <div class="col-md-6" align="center">
                     <img :src='url_prev' height="150px" align="center">
                  </div>
              </div>


                  
                 
                  
                
                  

               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" v-on:click="cerrarModal">Cerrar</button>
           <button type="button" class="btn btn-success" v-on:click="guardar_productos">Guardar</button>
          
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
            productos: {},
            producto_modal: {},
            error: '',
            file: '',
            url_prev:null,
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.obtener_productos()
        },
        methods: {
          asignaArchivo(e){
        this.file = e.target.files[0];
        this.url_prev = URL.createObjectURL(this.file);
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
          guardar_productos(){
              console.log('Guardando productos')
              var form = new FormData()
              if(this.producto_modal.id != undefined)
              form.append('id', this.producto_modal.id)
              form.append('archivo', this.file)
              form.append('nombre_producto', this.producto_modal.nombre_producto)
              form.append('precio_producto', this.producto_modal.precio_producto)
               form.append('detalle_producto', this.producto_modal.detalle_producto)
              form.append('area_producto', this.producto_modal.area_producto)
               form.append('stock_producto', this.producto_modal.stock_producto)
              axios.post('api/producto/guardar',form)
              .then((response) => {
                  console.log(response.data)
                  this.abreCierraModal()
                  this.obtener_productos()
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
          asignaProducto(producto){
            this.producto_modal = producto
            this.abreCierraModal()
          },
          editaProducto(){

              axios.post('api/producto/guardar', this.producto_modal)
              .then((response) => {
                  console.log(response.data)
                  this.abreCierraModal()
                  this.obtener_productos()
              })
              .catch((error) => {
                  console.log(error.data)
              })

          },
          nuevo_producto(){
              this.producto_modal = {}
              this.abreCierraModal()
          },
            eliminar_producto(producto){
              console.log('producto Eliminado')

              axios.post('api/producto/eliminar',producto)
              .then((response) => {
                  console.log(response.data)
                  this.obtener_productos()
              })
              .catch((error) => {
                  console.log(error.data)
              })
          }
        }
    }
</script>

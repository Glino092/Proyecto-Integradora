<template>

    <div class="container">
     
    
      <!-- carrito 
      <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Carrito</span>
              <span class="badge badge-secondary badge-pill">{{listCarrito.length}}</span>
            </h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Producto</h6>
                  <small class="text-muted"></small>
                </div>
                <span class="text-muted">{{listCarrito.lentgh}}</span>
              </li>
               <li v-for="(itemcart,i) in listCarrito" class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                   <h6 class="my-0">{{producto.nombre_producto}}</h6>
                  <small class="text-muted">{{producto.detalle_producto}}</small> 
                </div>

                <div>
                  <div>
                    <i class="material-icons"  v-on:click="cambiarCantidad(i,false)">remove_circle_outline</i>
                    <span class="text-muted"> {{itemcart.cant}}</span>
                    <i class="material-icons"  v-on:click="cambiarCantidad(i, true)">add_circle_outline</i> 
                  </div>
                <span class="text-muted"> {{(itemcart.cant * producto.precio_producto)}}</span> 
                </div>

                <i class="material-icons"  v-on:click="deleteItem(i)">delete</i>

              </li>

              <li class="list-group-item d-flex justify-content-between">
                <span>Total (PESOS)</span>
                 <strong> {{onViewTotal()}}</strong> 
              </li>
            </ul>

          </div>
-->

      <!-- Card -->
  <div class="container">
      <div class="col" v-for="producto in productos">
        <div class="card" style="width: 20rem;">
  <img v-if="producto.foto_producto" :src="producto.foto_producto.replace('public/','storage/')" width="150px">
  <div class="card-block">
    <h4 class="card-title">{{producto.nombre_producto}}</h4>
    <p class="card-text">Price: ${{producto.precio_producto}}</p>
    <!--<a href="#" class="btn btn-primary" v-on:click="addCart(producto)">{{(producto.precio_producto)}}</a> -->
       <button type="button" class="btn btn-info" v-on:click="asignaProducto(producto)">Mas informacion</button>
  </div>
</div>
      </div>
      </div>
<!--Modal -->
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
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nombre cliente:</label>
                       
                        <select name="id_cliente" id="inputCliente_id" class="form-control">
                        
                        <option v-for="cliente in clientes" :value="cliente.id_cliente">{{cliente.nombre_cliente}}</option>
                         
                        </select>
                        
          
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nombre producto:</label>
                        <input disabled type="text" v-model="producto_modal.nombre_producto" class="form-control" id="nombre_producto">
                     </div>
                  </div>


                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Descripcion Venta :</label>
                        <input type="text"  class="form-control" id="nombre_producto">
                     </div>
                  </div>

                  

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Fecha :</label>
                        <input type="date"  class="form-control" id="nombre_producto">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Hora :</label>
                        <input type="time"  class="form-control" id="nombre_producto">
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

<style>
body {
 
}

.show-cart li {
  display: flex;
}
.card {
  margin-bottom: 20px;
}
.card-img-top {
  width: 200px;
  height: 200px;
  align-self: center;
}

</style>

<script>
    export default {
        data(){
            return{
            productos: {},
            clientes: {},
            producto_modal: {},
            error: '',
            file: '',
            url_prev:null,
            listCarrito:[]
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.obtener_productos()
            this.obtener_clientes()
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
          },
          
          // convertMoney(value){

          // const formatterPeso = new Intl.NumberFormat('es-CO', {
          //    style: 'currency',
          //    currency: 'COP',
          //    minimumFractionDigits: 0
          //  })
          //  let valueFinal = formatterPeso.format(value);


          //  return valueFinal

          // },
          addCart(item){
            //this.listCarrito.push(item)

            const itemcar = {
              id : item.id,
              nombre: item.nombre_producto,
              cant: 1,
              precio: item.precio_producto
             }

            this.listCarrito.push(itemcar);
           // alert (item.nombre_producto);
            
          },
          deleteItem(i){ this.listCarrito.splice(i,1) 
          },
          cambiarCantidad(i,type){

              // sacar variable de carrito
              const dataCar = this.listCarrito

              // sacar la cantidad de producto
              let cantd = dataCar[i].cant;

              if (type) {
                cantd = cantd + 1
              }
              else if (type==false&&cantd>=1) {
                cantd = cantd - 1
              }

              if ((type==false&&cantd>=1)||type) {
                dataCar[i].cant = cantd
                this.listCarrito
              }


          },
          onViewTotal(){
            let total = 0
            this.listCarrito.map((data)=>{
              total = total + (data.cant * this.producto.precio_producto)
           })

            return (total)
          }

        }
    }
</script>

<template>
    <div class="card">
        <div class="card-header">En que estas pensando ahora.?</div>

            <div class="card-body">
                <!-- @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif -->
                

            <form action="" v-on:submit.prevent="nuevoPensamiento()">
                <div class="form-group">
                    <label for="textPensamiento">Ahora estoy pensando en:</label>
                    <input type="text" class="form-control" name="textPensamiento" id="textPensamiento" v-model="descripcion">
                </div>
                <button type="submit" class="btn btn-primary">Enviar Pensamiento</button>
            </form>
         </div>
     </div>
</template>

<script>
    export default {
        data() {
            return {
                descripcion:'',
            }
        },
        mounted() {
            // console.log('Component mounted.')
        },
        methods: {
            nuevoPensamiento(){

                let params = {
                    descripcion : this.descripcion
                }

                axios.post('/pensamientos',params).then((response) => {

                    console.log(response);
                    
                    let nuevoPensamiento =response.data;
                    this.$emit('nuevo',nuevoPensamiento);
                    
                }).catch((err) => {
                      console.log(err);

                });

                this.descripcion ='';
            }
        },
    }
</script>

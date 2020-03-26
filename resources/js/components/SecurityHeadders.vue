<template>
    <div>
         <div class="input-group mb-3">
          <input class="form-control" v-model="IP" placeholder="127.0.0.1">
         
          <div class="input-group-append">
         <input class="btn btn-outline-secondary" v-on:click="fetchSecurityHeadders" value="Test" type="submit">       
         </div>
        </div>
        <div>{{error}}</div>
        <div v-if="securityheadderstarted"> 
            <h2>Security headders</h2>
            <div v-if="loaded"> 
                <missingSH v-bind:missing="headers.missing"></missingSH>
                <presentSH v-bind:present="headers.present"></presentSH>
            </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>
    </div>
</template>

<script>
import presentSH from "./presentSH.vue"
import missingSH from "./missingSH.vue"
export default{
    name:"securityheadders",
    components: {
        presentSH,
        missingSH
    },
    data(){
        return {
            headers: { "present": {},
                        "missing": [] },
            loaded: false,
            securityheadderstarted: false,
            IP: "172.217.21.218",
            error:""
        }
    },

    methods: {
        fetchSecurityHeadders(){
            this.error="";
            this.securityheadderstarted=true;
            this.headers={ "present": {},
                        "missing": [] };
            this.loaded= false;
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/test',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.headers=result.headers;
                    this.loaded=true;

                    
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                     this.error=result.responseJSON.message;
                     this.securityheadderstarted=false;
                }.bind(this),
            });
        }
    }
}
</script>
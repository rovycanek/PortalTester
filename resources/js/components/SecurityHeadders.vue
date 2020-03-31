<template>
    <div>
         <div class="input-group mb-3">
          <input class="form-control" v-model="IP" placeholder="127.0.0.1">
         
          <div class="input-group-append">
         <input class="btn btn-outline-secondary" v-on:click="runTests" value="Test" type="submit">       
         </div>
        </div>
        <div>{{error}}</div>

        
        <div v-if="SH.started"> 
            <h2>Security headders</h2>
            <div v-if="SH.loaded"> 
                <missingSH v-bind:missing="SH.data.missing"></missingSH>
                <presentSH v-bind:present="SH.data.present"></presentSH>
            </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>



        <div v-if="HS.started"> 
            <h2>Handshake simulation</h2>
            <div v-if="HS.loaded"> 
                        <Handshakes v-bind:handshakes="HS.data"></Handshakes>
                    </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>

        <div v-if="SV.started"> 
            <h2>Security breaches</h2>
            <div v-if="SV.loaded"> 
                        <Handshakes v-bind:handshakes="SV.data"></Handshakes>
                    </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>

        <div v-if="CP.started"> 
            <h2>Offered protocols</h2>
            <div v-if="CP.loaded"> 
                        <Handshakes v-bind:handshakes="CP.data"></Handshakes>
                    </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>

        <div v-if="SHE.started"> 
            <h2>Server Hello</h2>
            <div v-if="SHE.loaded"> 
                        <Handshakes v-bind:handshakes="SHE.data"></Handshakes>
                    </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>

        <div v-if="CPP.started"> 
            <h2>Ciphers per protocol</h2>
            <div v-if="CPP.loaded"> 
                        <Handshakes v-bind:handshakes="CPP.data"></Handshakes>
                    </div>
            <div v-else>Loading...</div>
        </div>
        <div v-else></div>

    </div>
</template>

<script>
import presentSH from "./presentSH.vue"
import missingSH from "./missingSH.vue"
import Handshakes from "./Handshakes.vue"
export default{
    name:"securityheadders",
    components: {
        presentSH,
        missingSH,
        Handshakes
    },
    data(){
        return {
            SH: {"data" :{ "present": {},
                        "missing": [] },
                "loaded": false,
                 "started": false,
            },
            HS: {data: [],
            "loaded": false,
                 "started": false,
            },
            SV: {data: [],
            "loaded": false,
                 "started": false,
            },
            CP: {data: [],
            "loaded": false,
                 "started": false,
            },
            SHE: {data: [],
            "loaded": false,
                 "started": false,
            },
            CPP: {data: [],
                 "loaded": false,
                 "started": false,
            },
            IP: "172.217.21.218",
            error:"",
            
        }
    },

    methods: {
         runTests(){
            this.fetchSimulationHanshakes();
            this.fetchSecurityHeadders();
            this.fetchSecurityVulnerabities();
            this.fetchConnectionProtocols();
            this.fetchServerHello();
            this.fetchCiphersPherProtocol();

         },
       
        fetchSimulationHanshakes(){
            this.HS.started=true;
            this.HS.data=[];
            this.HS.loaded= false;
        
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/HS',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.HS.data=result.headers;
                    this.HS.loaded=true;
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                }.bind(this),
            });

        },


        fetchSecurityHeadders(){
            this.error="";
            this.SH.started=true;
            this.SH.data={ "present": {},
                        "missing": [] };
            this.SH.loaded= false;
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/SH',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.SH.data=result.headers;
                    this.SH.loaded=true;
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                     this.error=result.responseJSON.message;
                     this.SH.started=false;
                }.bind(this),
            });
        },
        fetchSecurityVulnerabities(){
            this.error="";
            this.SV.started=true;
            this.SV.data={ "present": {},
                        "missing": [] };
            this.SV.loaded= false;
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/SV',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.SV.data=result.headers;
                    this.SV.loaded=true;
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                     this.error=result.responseJSON.message;
                     this.SV.started=false;
                }.bind(this),
            });
        },

        fetchConnectionProtocols(){
            this.error="";
            this.CP.started=true;
            this.CP.data={ "present": {},
                        "missing": [] };
            this.CP.loaded= false;
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/CP',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.CP.data=result.headers;
                    this.CP.loaded=true;
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                     this.error=result.responseJSON.message;
                     this.CP.started=false;
                }.bind(this),
            });
        },


        fetchServerHello(){
            this.error="";
            this.SHE.started=true;
            this.SHE.data={ "present": {},
                        "missing": [] };
            this.SHE.loaded= false;
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/SHE',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.SHE.data=result.headers;
                    this.SHE.loaded=true;
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                     this.error=result.responseJSON.message;
                     this.CP.started=false;
                }.bind(this),
            });
        },
        fetchCiphersPherProtocol(){
            this.error="";
            this.CPP.started=true;
            this.CPP.data={ "present": {},
                        "missing": [] };
            this.CPP.loaded= false;
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/CPP',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.CPP.data=result.headers;
                    this.CPP.loaded=true;
                }.bind(this),
                error: function(result){
                    console.log(result.responseJSON.message);
                     this.error=result.responseJSON.message;
                     this.CPP.started=false;
                }.bind(this),
            });
        }

        


    }
}
</script>
<template>
    <div>
         <div v-if="errorenabled" class="alert alert-danger">{{error}}</div>
     <div class="card card-default" style="margin-bottom: 10px;">
        <div class="card-header"><H1 align="center">Welcome to SSL Tester</H1></div>
        <div class="card-body">
            <div class="input-group mb-3">
                <input class="form-control" v-model="IP" placeholder="127.0.0.1">
                
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" v-on:click="runTests" value="Test" type="submit">       
                </div>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="SecurityHeaddersCheckbox" v-model="SH.checkbox">
                <label class="form-check-label" for="SecurityHeaddersCheckbox">Security headders</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="HandshakesimulationCheckbox" v-model="HS.checkbox">
                <label class="form-check-label" for="HandshakesimulationCheckbox">Handshake simulation</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="SecurityBreachesCheckbox" v-model="SV.checkbox">
                <label class="form-check-label" for="SecurityBreachesCheckbox">Security breaches</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="OfferedProtocolsCheckbox" v-model="CP.checkbox">
                <label class="form-check-label" for="OfferedProtocolsCheckbox">Offered protocols</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ServerHelloCheckbox" v-model="SHE.checkbox">
                <label class="form-check-label" for="ServerHelloCheckbox">Server Hello</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="CiphersPerProtocolCheckbox" v-model="CPP.checkbox">
                <label class="form-check-label" for="CiphersPerProtocolCheckbox">Ciphers per protocol</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="Curl" v-model="CRL.checkbox">
                <label class="form-check-label" for="Curl">Curl</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="Nmap" v-model="NMP.checkbox">
                <label class="form-check-label" for="Nmap">Nmap</label>
            </div>
        </div>
    </div>

        
        
        <div v-if="SH.started" style="margin-bottom: 10px;"> 
            <div class="card card-default">
                <div class="card-header"><H3>{{SH.headding}}</H3></div>
                <div v-if="SH.loaded" class="card-body">
                    <presentSH v-bind:present="SH.data.present"></presentSH>
                    <missingSH v-bind:missing="SH.data.missing"></missingSH>
                </div>
                    <div v-else class="card-body">
                    <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;">Loading...</li>
                </div>
            </div>
        </div>


        <testSSL v-bind:data="HS"></testSSL>
        <testSSL v-bind:data="SV"></testSSL>
        <testSSL v-bind:data="CP"></testSSL>
        <testSSL v-bind:data="SHE"></testSSL>
        <testSSL v-bind:data="CPP"></testSSL>
        <Curl v-bind:data="CRL"></Curl>
        <testSSL v-bind:data="NMP"></testSSL>

    </div>
</template>

<script>
import presentSH from "./presentSH.vue"
import missingSH from "./missingSH.vue"
import testSSL from "./testSSL.vue"
import Curl from "./Curl.vue"
export default{
    name:"tests",
    components: {
        presentSH,
        missingSH,
        testSSL,
        Curl
    },
    data(){
        return {
            SecurityHeaddersCheckbox: true,
            SH: {"data" :{ "present": {},
                        "missing": {} },
                "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Security headders",
            },
            HS: {data: [],
                "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Handshake simulation",
            },
            SV: {data: [],
                "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Security breaches",
            },
            CP: {data: [],
                 "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Offered protocols",
            },
            SHE: {data: [],
                  "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Server Hello",
            },
            CPP: {data: [],
                 "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Ciphers per protocol",
            },
            CRL: {data: [],
                 "loaded": false,
                 "started": false,
                 "checkbox": true,
                 "headding": "Testing Curl",
            },
            NMP: {data: [],
                 "loaded": false,
                 "started": false,
                 "checkbox": false,
                 "headding": "Testing Nmap",
            },
            IP: "127.0.0.1",
            error:"",
            errorenabled:false,
            testID:{
                ID:"0",
            },
            
        }
    },

    methods: {
         runTests(){
            this.resetstates();
            this.testSaveToDB();
         },
         startTest(){
            if(this.HS.checkbox){
                this.fetchSimulationHanshakes();
            }
            if(this.SH.checkbox){
                this.fetchSecurityHeadders();
            }
            if(this.SV.checkbox){
                this.fetchSecurityVulnerabities();
            }
            if(this.CP.checkbox){
                this.fetchConnectionProtocols();
            }
            if(this.SHE.checkbox){
                this.fetchServerHello();
            }
            if(this.CPP.checkbox){
                this.fetchCiphersPherProtocol();
            }
            if(this.CRL.checkbox){
                this.fetchCurl();
            }
            if(this.NMP.checkbox){
                this.fetchNmap();
            }
         },

        testSaveToDB(){
            this.testID.success=false;
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/start',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                },
                success: function(result){
                    this.testID.ID=result.ID;
                    this.startTest();

                }.bind(this),
                error: function(result){
                    this.errorenabled = true;
                    this.error=result.responseJSON.errors.IP[0];
                  
                }.bind(this),
            });

        },

         resetstates(){
            this.errorenabled = false;
            this.HS.started=false;
            this.SH.started=false;
            this.SV.started=false;
            this.CP.started=false;
            this.SHE.started=false;
            this.CPP.started=false;
            this.CRL.started=false;
            this.NMP.started=false;
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
                    testID: this.testID.ID,
                },
                success: function(result){
                    this.HS.data=result.headers;
                    this.HS.loaded=true;
                }.bind(this),
                error: function(result){
                    this.error=result.responseJSON.message;
                    console.log(result.responseJSON.message);
                }.bind(this),
            });

        },
        fetchCurl(){
            this.CRL.started=true;
            this.CRL.data=[];
            this.CRL.loaded= false;
        
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/Curl',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                    testID: this.testID.ID,
                },
                success: function(result){
                    this.CRL.data=result.headers;
                    this.CRL.loaded=true;
                }.bind(this),
                error: function(result){
                    this.error=result.responseJSON.message;
                    console.log(result.responseJSON.message);
                }.bind(this),
            });
        },

        fetchNmap(){
            this.NMP.started=true;
            this.NMP.data=[];
            this.NMP.loaded= false;
        
            $.ajaxSetup({
                timeout: 3000000,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.post({
                url: '/tests/Nmap',
                datatype: 'json',
                data: {
                    name: "csrf-token",
                    IP: this.IP,
                    testID: this.testID.ID,
                },
                success: function(result){
                    this.NMP.data=result.headers;
                    this.NMP.loaded=true;
                }.bind(this),
                error: function(result){
                    this.error=result.responseJSON.message;
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
                    testID: this.testID.ID,
                },
                success: function(result){
                    this.SH.data.present=result.headersWith;
                    this.SH.data.missing=result.headersWithout;
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
                    testID: this.testID.ID,
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
                    testID: this.testID.ID,
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
                    testID: this.testID.ID,
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
                    testID: this.testID.ID,
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
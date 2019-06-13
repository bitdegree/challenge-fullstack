<template>
    <div id="authCard" class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div v-if="page === 'LOGIN' || page === 'REGISTER'" class="card-header"><a href="#"
                                                                                           v-on:click="infoSwitch">Go
                    Back!</a></div>
                <div v-else class="card-header">Authenthication card!</div>

                <div v-if="page === 'INFO'" class="card-body text-center">
                    <h2 class="my-5">You're not logged in!</h2>

                    <div class="row w-100 justify-content-center d-inline-block">
                        <button class="col-3 col-xs-6 col-sm-6 col-md-3 btn btn-secondary my-4 ml-1"
                                v-on:click="registerSwitch">Register
                        </button>
                        <button class="col-3 col-xs-6 col-sm-6 col-md-3 btn btn-secondary my-4 mr-1"
                                v-on:click="loginSwitch">Login
                        </button>
                    </div>
                </div>
                <div v-if="page === 'LOGIN'" class="card-body text-center">
                    <h2 class="my-5">Login!</h2>

                    <div v-if="loginData.error !== null" class="alert alert-danger">
                        <p>{{loginData.error}}</p>
                    </div>

                    <input class="my-2" placeholder="Email" v-model="loginData.email" type="email"/>
                    <input class="my-2" placeholder="Password" v-model="loginData.password" type="password"/>

                    <button class="btn btn-secondary my-4" v-on:click="loginAttempt">Login</button>
                </div>
                <div v-if="page === 'REGISTER'" class="card-body text-center">
                    <h2 class="my-5">Registration!</h2>

                    <div v-if="registerData.error !== null" class="alert alert-danger">
                        <p>{{registerData.error}}</p>
                    </div>

                    <input class="my-2" placeholder="Vardas" v-model="registerData.firstName" type="text"/>
                    <input class="my-2" placeholder="Pavardė" v-model="registerData.lastName" type="text"/>
                    <input class="my-2" placeholder="Email" v-model="registerData.email" type="email"/>
                    <input class="my-2" placeholder="Password" v-model="registerData.password" type="password"/>
                    <input class="my-2" placeholder="Confirm password" v-model="registerData.confirmPassword"
                           type="password"/>

                    <button class="btn btn-secondary my-4" v-on:click="registerAttempt">Register</button>
                </div>
                <div v-if="page === 'DASHBOARD'" class="card-body text-center">
                    <h2 class="my-5">Welcome back, {{user.firstName}} {{user.lastName}}</h2>

                    <div v-if="avatarData.error !== null" class="alert alert-danger">
                        <p>{{avatarData.error}}</p>
                    </div>

                    <input class="my-2" placeholder="Avataro URL" v-model="avatarData.url" type="text"/>

                    <div class="row w-100 justify-content-center d-inline-block">
                        <button class="col-3 col-xs-6 col-sm-6 col-md-3 btn btn-secondary my-4 ml-1"
                                v-on:click="setAvatar">Set avatar
                        </button>
                        <button class="col-3 col-xs-6 col-sm-6 col-md-3 btn btn-secondary my-4 mr-1"
                                v-on:click="logout">Log out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: () => {
            return {
                page: "INFO",
                jwt: null,
                user: null,
                loginData: {
                    error: null,
                    email: null,
                    password: null
                },
                registerData: {
                    error: null,
                    email: null,
                    password: null,
                    confirmPassword: null,
                    firstName: null,
                    lastName: null
                },
                avatarData: {
                    url: null,
                    error: null,
                }
            };
        },
        mounted() {
            let jwt = this.$cookies.get("jwt");

            if (jwt !== undefined)
                fetch(`${location.protocol}//${location.host}/api/status`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(
                        {
                            token: jwt
                        }
                    )
                }).then(
                    (response) => {
                        return response.json();
                    }
                ).then(
                    (json) => {
                        if (json.message !== undefined)
                            console.log(json.message);

                        else {
                            this.jwt = json.token;
                            this.user = json.user;
                            this.page = "DASHBOARD";
                            this.avatarData.url = json.user.avatarURL;

                            this.$cookies.set('jwt', json.token);

                            this.$emit("on-auth-status-changed", json.token, json.user);
                        }
                    }
                ).catch(
                    (e) => {
                        console.log(e);
                    }
                );
        },
        methods: {
            infoSwitch: function (event) {
                event.preventDefault();

                this.page = "INFO";
            },
            registerSwitch: function () {
                this.page = "REGISTER";
            },
            loginSwitch: function () {
                this.page = "LOGIN";
            },
            loginAttempt: function () {
                fetch(`${location.protocol}//${location.host}/api/login`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(
                        {...this.loginData}
                    )
                }).then(
                    (response) => {
                        return response.json();
                    }
                ).then(
                    (json) => {
                        if (json.message !== undefined)
                            this.loginData.error = json.message;

                        else {
                            this.loginData.error = null;
                            this.jwt = json.token;
                            this.user = json.user;
                            this.page = "DASHBOARD";
                            this.avatarData.url = json.user.avatarURL;

                            this.$cookies.set("jwt", json.token);

                            this.$emit("on-auth-status-changed", json.token, json.user);
                        }
                    }
                ).catch(
                    (e) => {
                        console.log(e);
                    }
                );
            },
            registerAttempt: function () {
                if (this.registerData.confirmPassword !== this.registerData.password)
                    this.registerData.error = "Passwords do not match!";

                else fetch(`${location.protocol}//${location.host}/api/register`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(
                        {...this.registerData}
                    )
                }).then(
                    (response) => {
                        return response.json();
                    }
                ).then(
                    (json) => {
                        if (json.message !== undefined)
                            this.registerData.error = json.message;

                        else {
                            this.registerData.error = null;
                            this.user = json.user;
                            this.jwt = json.token;
                            this.page = "DASHBOARD";
                            this.avatarData.url = json.user.avatarURL;

                            this.$cookies.set("jwt", json.token);

                            this.$emit("on-auth-status-changed", json.token, json.user);
                        }
                    }
                ).catch(
                    (e) => {
                        console.log(e);
                    }
                );
            },
            setAvatar: function () {
                fetch(
                    `${location.protocol}//${location.host}/api/avatar`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            token: this.jwt,
                            avatar: this.avatarData.url
                        })
                    }
                ).then(
                    (response) => {
                        return response.json();
                    }
                ).then((json) => {
                    if(json.message !== undefined)
                        this.avatarData.error = json.message;

                    else {
                        this.avatarData.error = null;
                    }
                });
            },
            logout: function () {
                fetch(
                    `${location.protocol}//${location.host}/api/register`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            token: this.jwt
                        })
                    }
                ).then(() => {
                    this.jwt = null;
                    this.user = null;
                    this.page = "INFO";
                    this.avatarData.url = null;

                    this.$cookies.remove('jwt');

                    this.$emit("on-auth-status-changed", null, null);
                });
            }
        }
    }

</script>

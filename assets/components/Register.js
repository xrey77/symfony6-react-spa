import React, { useState } from 'react'
import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000",
    headers: {'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': 'inherit'},
  })

function Register() {
    const [lastname, setLastname] = useState("");
    const [firstname, setFirstname] = useState("");
    const [email, setEmail] = useState("");
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [registerMessage, setregisterMessage] = useState("");

    const submitRegistration = (e) => {
        e.preventDefault();
        e.preventDefault();
        const data =JSON.stringify({ lastname: lastname, firstname: firstname, email: email, username: username, password: password });
        api.post("/user/register", data)
           .then((res) => { 
             if (res.data.message != null) {
                setregisterMessage(res.data.message);
              }            
            }, (error) => {
              setregisterMessage(error.message);
        });
    }

    return(
        <div class="modal fade" id="staticRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticRegisterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="staticLoginRegister">Account Registration</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form autoComplete='off'>                
                <div class="row">

                  <div class="col">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="first_name" defaultValue={lastname} onChange={e => setLastname(e.target.value)} placeholder="enter First Name" required="true"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="last_name" defaultValue={firstname} onChange={e => setFirstname(e.target.value)} placeholder="enter Last Name" required="true"/>
                    </div>
                  </div>

                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" id="pass_word" defaultValue={email} onChange={e => setEmail(e.target.value)} placeholder="enter Email Address"/>
                </div>

                <div class="row">

                  <div class="col">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="user_name" defaultValue={username} onChange={e => setUsername(e.target.value)} placeholder="enter Username" required="true"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                        <input type="password" class="form-control" id="pass_word" defaultValue={password} onChange={e => setPassword(e.target.value)} placeholder="enter Password" required="true"/>
                    </div>
                  </div>

                </div>
                <button onClick={submitRegistration} type="submit" class="btn btn-success">register</button>
              </form>
            </div>  
            <div class="modal-footer">
                <div id="msg" class="w-100 text-left msg">{registerMessage}</div>
            </div>
            </div>
        </div>
        </div>
    );
}

export default Register;
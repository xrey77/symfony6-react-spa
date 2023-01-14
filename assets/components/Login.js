import React, { useState } from 'react'

import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1.16:8000",
    headers: {'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': 'inherit'},
  })
  
function Login() {
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [loginmessage, setloginMessage] = useState("");


    const submitLogin = (e) => {
        e.preventDefault();      
        if ((username == null) && (password == null)) {
            alert("please enter username and password");
           return;
        } else {
  
          const data =JSON.stringify({ username: username, password: password });   
          api.post("/user/login", data)
             .then((res) => {    
               if (res.data.message != null) {
                  setloginMessage(res.data.message);
                  return;
                }
                setloginMessage("login successful");
                // if (res.data.otp > 0) {
                //   sessionStorage.setItem('USERID',res.data.id);
                //   sessionStorage.setItem('TOKEN',res.data.token);
                //   sessionStorage.setItem('ROLE',res.data.role);
                // } else {
                //   sessionStorage.setItem('TOKEN',res.data.token);
                //   sessionStorage.setItem('USERID',res.data.id);
                //   sessionStorage.setItem('USERNAME',res.data.username);
                //   sessionStorage.setItem('ROLE',res.data.role);
                //   sessionStorage.setItem('USERPIC',res.data.userpicture);
                // }
                
              }, (error) => {
  
              setloginMessage(error.message);         
              return;
          });
        }      
    }

    return(
        <div className="modal fade" id="staticLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLoginLabel" aria-hidden="true">
        <div className="modal-dialog modal-sm modal-dialog-centered">
            <div className="modal-content">
            <div className="modal-header bg-primary">
                <h1 className="modal-title fs-5 text-white" id="staticLoginLabel">User's Login</h1>
                <button type="button" className="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div className="modal-body">

              <form autoComplete='off'>                
                <div className="mb-3">
                    <input type="text" className="form-control" id="user_name" defaultValue={username} onChange={e => setUsername(e.target.value)} placeholder="enter username"/>
                </div>
                <div className="mb-3">
                    <input type="password" className="form-control" id="pass_word" defaultValue={password} onChange={e => setPassword(e.target.value)} placeholder="enter password"/>
                </div>
                <button onClick={submitLogin} type="submit" className="btn btn-primary">login</button>
              </form>

            </div>  
            <div className="modal-footer">
                <div id="msg" className="w-100 text-left msg">{loginmessage}</div>
            </div>
            </div>
        </div>
        </div>
    );
}

export default Login;
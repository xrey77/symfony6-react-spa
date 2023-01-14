import React, {useEffect} from 'react';
import { Link, useLocation } from "react-router-dom";
import logo from '../../public/images/wincor.png';
import bar from '../../public/images/burger.png';
import Login from './Login';
import Register from './Register';

function Header() {
    const location = useLocation();
    const pageLinks = [
        {
            "name": "Home",
            "url" :"/",
        },
    ];
  
    useEffect(() => {
        pageLinks.map((page)=>{
            if(page.url == location.pathname) {
                document.title = page.name;
            }
        });
    }, [])
  
    return (
    <div>
        <nav className="navbar navbar-expand-lg navbar-light fixed-top bg-secondary">
        <div className="container-fluid">
            <Link className="navbar-brand" to="/"><img className='logo' src={logo} alt="logo"/></Link>

                <button class="btn bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">

                    <span className="navbar-toggler-icon"><img class="burger" src={bar} /></span>
                </button>
  
             <div className="collapse navbar-collapse" id="navbarSupportedContent">
                
            <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                <li className="nav-item">
                <Link className="nav-link text-white active" aria-current="page" to="/about">About Us</Link>
                </li>
                <li className="nav-item dropdown">
                <a className="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Services
                </a>
                <ul className="dropdown-menu">
                    <li><Link className="dropdown-item" to="/servicehome">Onsite Service</Link></li>
                    <li><Link className="dropdown-item" to="/callcenter">Call Center</Link></li>
                    <li><hr className="dropdown-divider"/></li>
                    <li><Link className="dropdown-item" to="/productdelivery">ATM Monitoring 24/7</Link></li>
                </ul>
                </li>

                <li className="nav-item dropdown">
                <a className="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Products
                </a>
                <ul className="dropdown-menu">
                    <li><Link className="dropdown-item" to="/cars">Self Service Terminals (ATM)</Link></li>
                    <li><Link className="dropdown-item" to="/autospareparts">ATM Spare Parts</Link></li>
                    <li><hr className="dropdown-divider"/></li>
                    <li><Link className="dropdown-item" to="/carcareproducts">ATM Care Products</Link></li>
                </ul>
                </li>

                <li className="nav-item">
                    <Link className="nav-link text-white" to="/contact">Contact Us</Link>
                </li>
            </ul>
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <a className="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#staticLogin">Login</a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#staticRegister">Register</a>
                    </li>
                </ul>
            </div>

        </div> 
        </nav>        

                    {/* OFF CANVAS MENU */}
                    <div class="offcanvas bg-light offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="staticBackdropLabel"><img className='logo' src={logo} alt="logo"/></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">


                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <Link class="nav-link active" aria-current="page" to="/about">About Us</Link>
                            </li>
                            <li><hr/></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Services</a>
                                <ul class="dropdown-menu">
                                    <li><Link class="dropdown-item" to="/servicehome">Onsite Service</Link></li>
                                    <li><hr class="dropdown-divider"/></li>
                                    <li><Link class="dropdown-item" to="/callcenter">Call Center</Link></li>
                                    <li><hr class="dropdown-divider"/></li>
                                    <li><Link class="dropdown-item" to="/productdelivery">ATM Monitoring 24/7</Link></li>
                                </ul>
                            </li>
                            <li><hr/></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Products</a>
                                <ul class="dropdown-menu">
                                    <li><Link class="dropdown-item" to="/cars">Self Service Terminals (ATM)</Link></li>
                                    <li><hr class="dropdown-divider"/></li>
                                    <li><Link class="dropdown-item" to="/autospareparts">ATM Spare Parts</Link></li>
                                    <li><hr class="dropdown-divider"/></li>
                                    <li><Link class="dropdown-item" to="/carcareproducts">ATM Care Products</Link></li>
                                </ul>
                            </li>
                            <li><hr/></li>
                            <li class="nav-item">
                                <Link class="nav-link active" aria-current="page" to="/contact">Contact Us</Link>
                            </li>
                            <li><hr/></li>
                            <li class="nav-item">
                                <a className="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#staticLogin">Login</a>
                            </li>
                            <li><hr/></li>
                            <li class="nav-item">
                                <a className="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#staticRegister">Register</a>
                            </li>

                        </ul>



                        </div>
                    </div>

                    {/* END VERTICAL MENU */}
                     <Login/>
                    <Register/>


    </div>
    );
}
   
export default Header;
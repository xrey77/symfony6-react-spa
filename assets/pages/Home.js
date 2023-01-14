import React from 'react'
import Layout from "../components/Layout"
import prod1 from '../../public/images/prod1.png'
import prod2 from '../../public/images/prod2.png'
import prod3 from '../../public/images/prod3.png'
import atm1 from '../../public/images/atm1.jpeg'
import atm2 from '../../public/images/atm2.jpeg'
import atm3 from '../../public/images/atm3.jpeg'

function Home() {
  
    return (
    <div  class="layout-height">
        <Layout> 
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner ximg">
                    <div class="carousel-item active">
                        <img src={prod1} class="d-block w-100" alt="..."/>
                    </div>
                    <div class="carousel-item">
                        <img src={prod2} class="d-block w-100" alt="..."/>
                    </div>
                    <div class="carousel-item">
                        <img src={prod3} class="d-block w-100" alt="..."/>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <hr/>
            
            <div class="card-group">
                <div class="card">
                    <img src={atm1} class="card-img-top card-img" alt="ATM 1"/>
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text card-txt">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted card-txt">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src={atm2} class="card-img-top card-img" alt="ATM 2"/>
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text card-txt">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted card-txt">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src={atm3} class="card-img-top card-img" alt="ATM 3"/>
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text card-txt">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted card-txt">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>            
            <br/><br/>

        </Layout>
        </div>        
    );
}
   
export default Home;
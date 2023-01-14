import React from 'react';
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from "./pages/Home"
import Blog from "./pages/Blog"
import About from "./pages/About"
import Contact from "./pages/Contact"
import NotFound from "./pages/NotFound"
import ServiceHome from "./pages/Services/ServiceHome"
import CallCenter from './pages/Services/CallCenter'     
import ProductDelivery from './pages/Services/ProductDelivery'
import Cars from './pages/products/Cars'
import AutoSpareParts from './pages/products/AutoSpareParts'
import CarCareProducts from './pages/products/CarCareProducts';

function Main() {
    return (
        <Router>
            <Routes>
                <Route exact path="/"  element={<Home/>} />
                <Route path="/blog"  element={<Blog/>} />
                <Route path="/about"  element={<About/>} />
                <Route path="/contact"  element={<Contact/>} />
                <Route path="/servicehome" element={<ServiceHome/>} />
                <Route path="/callcenter" element={<CallCenter/>} />
                <Route path="/productdelivery" element={<ProductDelivery/>} />
                <Route path="/cars" element={<Cars/>} />
                <Route path="/autospareparts" element={<AutoSpareParts/>} />
                <Route path="/carcareproducts" element={<CarCareProducts/>} />

                <Route path="*" element={<NotFound/>} />
            </Routes>
        </Router>
    );
}
     
export default Main;
     
if (document.getElementById('app')) {
    const rootElement = document.getElementById("app");
    const root = createRoot(rootElement);
 
    root.render(
        <StrictMode>
            <Main />
        </StrictMode>
    );
}
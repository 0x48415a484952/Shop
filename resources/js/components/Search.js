import React from "react";
import R from './R.js';
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faShoppingCart, faSearch, faBars } from "@fortawesome/free-solid-svg-icons";
function Search() {
    return(
        <div className="">
            <section className="bg-white">
                <div className="container mx-auto">
                    <header className="header-top w-full md:py-4">
                        <div className="flex flex-wrap">
                            <div className="flex justify-start items-center text-white p-2 w-5/6 md:w-8 lg:hidden">
                                <div className="flex w-2/6 cursor-pointer items-center lg:hidden">
                                    <a className="text-nikan-brown lg:hidden" href="#"><FontAwesomeIcon size="2x" icon={faBars} /></a>
                                </div>
                                <div className="md:hidden flex p-2 items-center w-4/6">
                                    <h2 className="text-nikan-brown">{R.WebsiteName}</h2>
                                </div>
                            </div>
                            <div className="flex justify-end text-nikan-brown p-2 w-1/6 items-center md:hidden">
                                <a className="text-nikan-brown md:hidden" href="#"><FontAwesomeIcon size="lg" icon={faShoppingCart} /></a>
                            </div>
                            <div className="flex flex-1 px-2">
                                <h1 className="hidden md:flex text-nikan-brown items-center">{R.WebsiteName}</h1>
                                <div className="flex flex-1 border-2 border-nikan-brown rounded-full mb-4 md:mb-0 md:mx-2">
                                    <input className="flex flex-1 p-2 md:text-lg search-rounded-full-input bg-grey-lighter" type="text" placeholder="search"/>
                                    <button className="flex items-center bg-grey-lighter p-2 md:p-4 text-xs hover:bg-green-dark text-nikan-brown hover:text-white search-rounded-full-button">
                                        <FontAwesomeIcon size="lg" icon={faSearch} />
                                    </button>
                                </div>
                                <a className="text-nikan-brown hidden md:flex items-center" href="#">
                                    <div className="flex items-center border-2 border-nikan-brown rounded p-2">
                                        <p className="">Cart(0)</p>
                                        <FontAwesomeIcon size="2x" icon={faShoppingCart} />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </header>
                </div>
            </section>
        </div>
    )
}

export default Search
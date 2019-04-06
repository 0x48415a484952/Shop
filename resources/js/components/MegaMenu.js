import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faAngleRight } from "@fortawesome/free-solid-svg-icons";


function MegaMenu() {
    return (
        <div className="sticky pin-t z-50">
            <section className="bg-nikan-brown hidden lg:flex">
                <div className="container mx-auto">
                    <nav className="bg-nikan-brown flex text-sm px-2 justify-between">
                        <ul className="flex  flex-1 list-reset relative justify-start">
                            <li className="hover:bg-nikan-orange"><a className="p-2 block text-white" href="#">Home</a></li>
                            <li className="hover:bg-nikan-orange submenu"><a className="p-2 block text-white" href="#" title="">Products</a>
                                <ul className="flex w-full flex-wrap megamenu rounded mx-2">
                                    <ul>
                                        <h4>Anything</h4>
                                        <li><a className="block text-white" href="#">DDR</a></li>
                                        <li><a className="block text-white" href="#">DDR2</a></li>
                                        <li><a className="block text-white" href="#">DDR3</a></li>
                                        <li><a className="block text-white" href="#">DDR4</a></li>
                                        <li><a className="block text-white" href="#">NoteBook</a></li>
                                        <li><a className="block text-white" href="#">Power Supply</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Storages</h4>
                                        <li><a className="block text-white" href="#">Internal Hdd</a></li>
                                        <li><a className="block text-white" href="#">External Hdd</a></li>
                                        <li><a className="block text-white" href="#">SSD (Solid State Drive)</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Cables and Other Shits</h4>
                                        <li><a className="block text-white" href="#">PC-Cables</a></li>
                                        <li><a className="block text-white" href="#">Laptop Cables</a></li>
                                        <li><a className="block text-white" href="#">NoteBook Cables</a></li>
                                        <li><a className="block text-white" href="#">Miner Cables</a></li>
                                        <li><a className="block text-white" href="#">Other Cables</a></li>
                                    </ul>
                                    <ul>
                                        <h4>VGA</h4>
                                        <li><a className="block text-white" href="#">AMD</a></li>
                                        <li><a className="block text-white" href="#">Nvidia</a></li>
                                        <li><a className="block text-white" href="#">intel</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Portable Storage</h4>
                                        <li><a className="block text-white" href="#">Compact Disc</a></li>
                                        <li><a className="block text-white" href="#">DVD</a></li>
                                        <li><a className="block text-white" href="#">Bluray</a></li>
                                        <li><a className="block text-white" href="#">DVD 9</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Processors</h4>
                                        <li><a className="block text-white" href="#">AMD</a></li>
                                        <li><a className="block text-white" href="#">Intel</a></li>
                                        <li><a className="block text-white" href="#">Qualcomm</a></li>
                                        <li><a className="block text-white" href="#">Nvidia</a></li>
                                        <li><a className="block text-white" href="#">Chinese</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Processors</h4>
                                        <li><a className="block text-white" href="#">AMD</a></li>
                                        <li><a className="block text-white" href="#">Intel</a></li>
                                        <li><a className="block text-white" href="#">Qualcomm</a></li>
                                        <li><a className="block text-white" href="#">Nvidia</a></li>
                                        <li><a className="block text-white" href="#">Chinese</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Network</h4>
                                        <li><a className="block text-white" href="#">Hubs and Switches</a></li>
                                        <li><a className="block text-white" href="#">Router</a></li>
                                        <li><a className="block text-white" href="#">Firewalls</a></li>
                                        <li><a className="block text-white" href="#">Powerline</a></li>
                                        <li><a className="block text-white" href="#">Cable</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Pripherals</h4>
                                        <li><a className="block text-white" href="#">Controller</a></li>
                                        <li><a className="block text-white" href="#">Cable</a></li>
                                        <li><a className="block text-white" href="#">Adapter</a></li>
                                    </ul>
                                    <ul>
                                        <h4>Pripherals</h4>
                                        <li><a className="block text-white" href="#">Controller</a></li>
                                        <li><a className="block text-white" href="#">Cable</a></li>
                                        <li><a className="block text-white" href="#">Adapter</a></li>
                                    </ul>
                                </ul>
                            </li>
                            <li><a className="p-2 hover:bg-nikan-orange block text-white" href="#">Another one</a></li>
                            <li><a className="p-2 hover:bg-nikan-orange block text-white" href="#">Contacts Pripherals</a></li>
                            <li><a className="p-2 hover:bg-nikan-orange block text-white" href="#">Other shit</a></li>
                            <li className="hover:bg-nikan-orange submenu"><a className="p-2 block text-white" href="#" title="">Products</a>
                                <ul className="flex flex-wrap w-full megamenu2 rounded text-xs">
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Anything</h4>
                                            <li><a className="block text-white" href="#">DDR</a></li>
                                            <li><a className="block text-white" href="#">DDR2</a></li>
                                            <li><a className="block text-white" href="#">DDR3</a></li>
                                            <li><a className="block text-white" href="#">DDR4</a></li>
                                            <li><a className="block text-white" href="#">NoteBook</a></li>
                                            <li><a className="block text-white" href="#">Power Supply</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Storages</h4>
                                            <li><a className="block text-white" href="#">Internal Hdd</a></li>
                                            <li><a className="block text-white" href="#">External Hdd</a></li>
                                            <li><a className="block text-white" href="#">SSD (Solid State Drive)</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Cables and Other Shits</h4>
                                            <li><a className="block text-white" href="#">PC-Cables</a></li>
                                            <li><a className="block text-white" href="#">Laptop Cables</a></li>
                                            <li><a className="block text-white" href="#">NoteBook Cables</a></li>
                                            <li><a className="block text-white" href="#">Miner Cables</a></li>
                                            <li><a className="block text-white" href="#">Other Cables</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>VGA</h4>
                                            <li><a className="block text-white" href="#">AMD</a></li>
                                            <li><a className="block text-white" href="#">Nvidia</a></li>
                                            <li><a className="block text-white" href="#">intel</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Portable Storage</h4>
                                            <li><a className="block text-white" href="#">Compact Disc</a></li>
                                            <li><a className="block text-white" href="#">DVD</a></li>
                                            <li><a className="block text-white" href="#">Bluray</a></li>
                                            <li><a className="block text-white" href="#">DVD 9</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Processors</h4>
                                            <li><a className="block text-white" href="#">AMD</a></li>
                                            <li><a className="block text-white" href="#">Intel</a></li>
                                            <li><a className="block text-white" href="#">Qualcomm</a></li>
                                            <li><a className="block text-white" href="#">Nvidia</a></li>
                                            <li><a className="block text-white" href="#">Chinese</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Processors</h4>
                                            <li><a className="block text-white" href="#">AMD</a></li>
                                            <li><a className="block text-white" href="#">Intel</a></li>
                                            <li><a className="block text-white" href="#">Qualcomm</a></li>
                                            <li><a className="block text-white" href="#">Nvidia</a></li>
                                            <li><a className="block text-white" href="#">Chinese</a></li>
                                        </ul>
                                    </div>
                                    <div className="w-1/6">
                                        <ul className="px-2">
                                            <h4>Network</h4>
                                            <li><a className="block text-white" href="#">Hubs and Switches</a></li>
                                            <li><a className="block text-white" href="#">Router</a></li>
                                            <li><a className="block text-white" href="#">Firewalls</a></li>
                                            <li><a className="block text-white" href="#">Powerline</a></li>
                                            <li><a className="block text-white" href="#">Cable</a></li>
                                        </ul>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                        <ul className="list-reset relative flex justify-end">
                            <li className="bg-nikan-orange"><a className="p-2 block text-white" href="#">Buy In lists</a></li>
                        </ul>
                    </nav>
                </div>
            </section>
        </div>
    )
}

export default MegaMenu
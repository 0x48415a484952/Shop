import React from "react"

function Header() {
    return (
        <div>
            {/*
            <section className="overflow-hidden">
                <div className="colorful-slider"></div>
            </section>
            */}
            <section className="bg-nikan-brown">
                <div className="container mx-auto">
                    <div className="header-lang py-2 text-xs px-2">
                        <div className="flex w-full justify-between md:w-1/4">
                            <a className="text-white" href="#">Sign in</a>
                            <a className="text-white" href="#">Sign up</a>
                            <a className="text-white" href="#">Language</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default Header
import React from 'react'
import Header from './Header'
import Main from './Main'
import Search from './Search'
import MegaMenu from './MegaMenu'
import Products from './Products'
import Footer from './Footer'
import Breadcrumb from './breadcrumb';
//import Carousel from './Carousel';
//import Slider from './slider';
//import newCarousel from './newCarousel';
//import Amazing from './Amazing';
import GoToTop from './GoToTop';
import NewsLetter from './NewsLetter';
import CopyRight from './CopyRight';
import Filters from './Filters';

function Landing() {
    return(
        <div>
            <main className="min-h-screen bg-white">
                <Header />
                <Search />
                <MegaMenu />
                { /* breadcrumb rendering */ }
                <div>
                    <section>
                        <div className="container mx-auto">
                            <nav className="p-2">
                                <ul className="breadcrumb flex list-reset text-sm border-t border-grey py-2 lg:border-0">
                                    <Breadcrumb  BreadcrumbLink="Processor"/>
                                    <Breadcrumb BreadcrumbLink="Intel" />
                                    <Breadcrumb BreadcrumbLink="I7" />
                                </ul>
                            </nav>
                        </div>
                    </section>
                </div>
                { /* end of breadcrumbs */ }
                <Filters />
                <Products />
                
                { /* <Carousel /> */ }
                { /* <Slider /> */ }
                {/* <Amazing /> */}
                <Main />
            </main>
            <GoToTop />
            <Footer />
            <NewsLetter />
            <CopyRight />
        </div>
    )
}

export default Landing
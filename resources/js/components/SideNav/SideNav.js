import React from 'react'
import { Link, useLocation } from 'react-router-dom'

const SideNav = () => {
    let currentPath = useLocation().pathname

    const navItems = [
        {
            name: 'Dashboard',
            path: '/',
            className: 'fas fa-home',
        },
        {
            name: 'Resource Groups',
            path: '/rgroups',
            className: 'fas fa-layer-group',
        },
        {
            name: 'Scopes',
            path: '/scopes',
            className: 'fas fa-microscope',
        },
        {
            name: 'Users',
            path: '/users',
            className: 'fas fa-users',
        },
        {
            name: 'Roles and Permissions',
            path: '/rp',
            className: 'fas fa-exclamation-triangle',
        },
    ].map(item => {
        return (
            <Link className="nav-item" to={item.path} key={item.path}>
                <li className={`nav-link text-white ${currentPath == item.path ? "active" : ""}`}>
                    <i className={`fa ${item.className} pr-1`}></i>
                    {item.name} {currentPath == item.path ? <span className="sr-only">(current)</span> : ""}
                </li>
            </Link>
        )
    })

    return (
        <nav id="sidebarMenu" className="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div className="sidebar-sticky pt-3">
                <ul className="nav flex-column">
                    { navItems }
                </ul>
            </div>
        </nav>
    )
}

export default SideNav

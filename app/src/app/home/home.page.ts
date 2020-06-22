import { base_url } from './../config';
import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http'
import Swal from 'sweetalert2'
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  parcel_info: any = {}
  constructor(
    private http: HttpClient,
    private router: Router
  ) { }



  save_info() {
    Swal.showLoading()
    const save_request = {
      request: "collect_parcel",
      body: this.parcel_info
    }
    this.http.post(base_url, save_request)
      .subscribe(
        (success_response) => {
          Swal.hideLoading()
          console.log(success_response)
        },
        (error) => {
          Swal.hideLoading()
          console.log(error)
        }
      )
    // console.log(save_request)
  }



  collect_parcel() {
    this.router.navigateByUrl('collectparcel')
  }

}

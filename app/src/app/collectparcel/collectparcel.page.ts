import { base_url } from './../config';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import Swal from 'sweetalert2'
@Component({
  selector: 'app-collectparcel',
  templateUrl: './collectparcel.page.html',
  styleUrls: ['./collectparcel.page.scss'],
})
export class CollectparcelPage implements OnInit {

  parcel_info: any = {}
  constructor(
    private http: HttpClient
  ) { }

  ngOnInit() {
  }

  get_parcel_info() {
    Swal.showLoading()
    const parcel_request = {
      body: this.parcel_info,
      request: 'collection_point'
    }

    this.http.post(base_url, parcel_request)
      .subscribe(
        (success) => {
          Swal.hideLoading()
          console.log(success)
        },
        (error) => {
          Swal.hideLoading()
          console.log(error)
        }
      )

  }

}

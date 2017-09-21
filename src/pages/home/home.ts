import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';


@Component({
	selector: 'page-home',
	templateUrl: 'home.html'
})
export class HomePage {

	public items : any = [];
	constructor(public navCtrl: NavController, public http: Http)
	{

	}


	ionViewWillEnter()
	{
		this.load();
	}

   // Retrieve the JSON encoded data from the remote server
   // Using Angular's Http class and an Observable - then
   // assign this to the items array for rendering to the HTML template
   load()
   {
   	this.http.get('http://localhost/ionic/retrieve.php')
   	.map(res => res.json())
   	.subscribe(data =>
   	{
   		this.items = data;
   	});
   }

   tambahData(){
   	this.navCtrl.push('InputBiodata');
   }

   lihatData(param){
   	this.navCtrl.push('InputBiodata', param);
   }

}
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
        <div class="icon"><i class="fa green fa-dollar"></i>
        </div>
        <div class="count">
        @if(isset($total_balance->available[0]))
				 		 $ {{ $total_balance->available[0]->amount}}
				 		 <span class="green" style="font-size: 20px;">  {{$total_balance->available[0]->currency }} </span>
				 @endif</div>

        <h3>Stripe Balance </h3>
        <p>Total available balance .</p>
    </div>
</div>
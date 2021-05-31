<?php $running_year = $this->db->get_where('school' , array('school_id'=>$this->session->userdata('school_id')))->row()->running_year;
$school_id = $this->session->userdata('school_id');
 ?>

<hr />
<div class="row">
    <div class="col-sm-6">
        <div class="col-sm-12" style="">
            Income
        </div>
        <div class="col-sm-12" style="font-size: 20px;text-align: center;">
            <?php 

            $this->db->select_sum('amount');
            $total_income = $this->db->get_where('payment', array('school_id' => $school_id,'payment_type'=>'income'));
            $income=$total_income->row()->amount; ?>
            Total Income : <?php echo $income; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="col-sm-12" style="">
            Expenses
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <td>Category</td>
                        <td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $category=$this->db->get_where('expense_category', array('school_id' => $school_id))->result_array();$total_expense=0; ?>
                    <?php foreach ($category as $row): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td> <?php 
                                    $this->db->select_sum('amount');
                                    $expense = $this->db->get_where('payment', array('school_id' => $school_id,'payment_type'=>'expense','expense_category_id'=>$row['expense_category_id']));
                                    echo $exp=$expense->row()->amount;
                                    $total_expense += $exp;
                                     ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr style="font-size: 20px;">
                        <td>Total</td>
                        <td><?php echo $total_expense; ?></td>
                    </tr>
                </tbody>
            </table>
            
            

            
            
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12" style="font-size: 20px;">
        <?php $diff = $income-$total_expense;
        if ($diff >= 0) {
            echo  '<p style="color : green;font-size:20px;">' .'Profit : ' . $diff . '</p>';
        }else {
            echo  '<p style="color:red;font-size:20px;">' . 'Loss : ' . (0-$diff) . '</p>';
        }


         ?>
    </div>
</div>
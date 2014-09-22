/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GRoleTask extends Rpc.Data
/*    */ {
/*    */   public Octets task_data;
/*    */   public Octets task_complete;
/*    */   public Octets task_finishtime;
/*    */   public Rpc.Data.DataVector task_inventory;
/*    */ 
/*    */   public GRoleTask()
/*    */   {
/* 17 */     this.task_data = new Octets();
/* 18 */     this.task_complete = new Octets();
/* 19 */     this.task_finishtime = new Octets();
/* 20 */     this.task_inventory = new Rpc.Data.DataVector(new GRoleInventory());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 25 */     os.marshal(this.task_data);
/* 26 */     os.marshal(this.task_complete);
/* 27 */     os.marshal(this.task_finishtime);
/* 28 */     os.marshal(this.task_inventory);
/* 29 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 34 */     os.unmarshal(this.task_data);
/* 35 */     os.unmarshal(this.task_complete);
/* 36 */     os.unmarshal(this.task_finishtime);
/* 37 */     os.unmarshal(this.task_inventory);
/* 38 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 45 */       GRoleTask o = (GRoleTask)super.clone();
/* 46 */       o.task_data = ((Octets)this.task_data.clone());
/* 47 */       o.task_complete = ((Octets)this.task_complete.clone());
/* 48 */       o.task_finishtime = ((Octets)this.task_finishtime.clone());
/* 49 */       o.task_inventory = ((Rpc.Data.DataVector)this.task_inventory.clone());
/* 50 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 53 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleTask
 * JD-Core Version:    0.6.2
 */
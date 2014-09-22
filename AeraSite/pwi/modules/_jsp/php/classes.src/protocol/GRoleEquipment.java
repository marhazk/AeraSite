/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GRoleEquipment extends Rpc.Data
/*    */ {
/*    */   public Rpc.Data.DataVector inv;
/*    */ 
/*    */   public GRoleEquipment()
/*    */   {
/* 14 */     this.inv = new Rpc.Data.DataVector(new GRoleInventory());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.inv);
/* 20 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 25 */     os.unmarshal(this.inv);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 33 */       GRoleEquipment o = (GRoleEquipment)super.clone();
/* 34 */       o.inv = ((Rpc.Data.DataVector)this.inv.clone());
/* 35 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 38 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleEquipment
 * JD-Core Version:    0.6.2
 */
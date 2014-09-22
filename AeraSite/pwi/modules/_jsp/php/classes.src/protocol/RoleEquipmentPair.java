/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class RoleEquipmentPair extends Rpc.Data
/*    */ {
/*    */   public RoleId key;
/*    */   public Rpc.Data.DataVector equipment;
/*    */ 
/*    */   public RoleEquipmentPair()
/*    */   {
/* 15 */     this.key = new RoleId();
/* 16 */     this.equipment = new Rpc.Data.DataVector(new GRoleInventory());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.key);
/* 22 */     os.marshal(this.equipment);
/* 23 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 28 */     os.unmarshal(this.key);
/* 29 */     os.unmarshal(this.equipment);
/* 30 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 37 */       RoleEquipmentPair o = (RoleEquipmentPair)super.clone();
/* 38 */       o.key = ((RoleId)this.key.clone());
/* 39 */       o.equipment = ((Rpc.Data.DataVector)this.equipment.clone());
/* 40 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 43 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.RoleEquipmentPair
 * JD-Core Version:    0.6.2
 */